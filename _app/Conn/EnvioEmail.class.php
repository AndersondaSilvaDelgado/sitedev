<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Email
 *
 * @author anderson
 */
class EnvioEmail extends Conn {
    //put your code here

    /** @var PDO */
    private $Conn;

    public function envio($dados) {

        $email = ''; 
        
        if($dados['departamento'] == 1){
            $email = 'joao.rogante@usinasantafe.com.br; laura.vicentini@usinasantafe.com.br;';
        }
        elseif($dados['departamento'] == 2){
            $email = 'marcio@usinasantafe.com.br';
        }
        elseif($dados['departamento'] == 3){
            $email = 'silvia@usinasantafe.com.br';
        }
        elseif($dados['departamento'] == 4){
            $email = 'compras@usinasantafe.com.br';
        }
        elseif($dados['departamento'] == 5){
            $email = 'marcio@usinasantafe.com.br';
        }
        else{
            $email = 'anderson@usinasantafe.com.br';
        }
        
		if(!empty($dados['mensagem']) && ($dados['nome'] !== 'HenryjaB')){
			
			$msg = preg_replace('/(http[s]{0,1}\:\/\/\S{4,})\s{0,}/ims', '', $dados['mensagem']);
			
			$this->Connect();
			$sql = "CALL USINAS.PK_ENVIA_EMAIL.PB_ENVIA_EMAIL (  'ti@usinasantafe.com.br' " 
                               . " , '" . $email . "' " 
                               . " , 'MENSAGEM - SITE DA EMPRESA' "
                               . " , 'NOME: " . $dados['nome']
                               . " ' || chr(13) || 'E-MAIL:  " . $dados['email']
                               . " ' || chr(13) || 'TELEFONE:  " . $dados['telefone']
                               . " ' || chr(13) || 'MSG: " . $msg . "'"
                               . " , null  "
                               . " , null)";

			$stmt = $this->Conn->prepare($sql);
			$stmt->execute();
		
		}
		
    }

    private function Connect() {
        $this->Conn = parent::getConn();
    }

}
