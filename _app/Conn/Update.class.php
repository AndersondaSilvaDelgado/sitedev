<?php

/**
 * <b>Update.class:</b>
 * Classe responsável por atualizações genéticas no banco de dados!
 * 
 * @copyright (c) 2014, Robson V. Leite UPINSIDE TECNOLOGIA
 */
class Update extends Conn {

    private $Tabela;
    private $Dados;
    private $Termos;
    private $Places;
    private $Result;

    /** @var PDOStatement */
    private $Update;

    /** @var PDO */
    private $Conn;

    /**
     * <b>Exe Update:</b> Executa uma atualização simplificada com Prepared Statments. Basta informar o 
     * nome da tabela, os dados a serem atualizados em um Attay Atribuitivo, as condições e uma 
     * analize em cadeia (ParseString) para executar.
     * @param STRING $Tabela = Nome da tabela
     * @param ARRAY $Dados = [ NomeDaColuna ] => Valor ( Atribuição )
     * @param STRING $Termos = WHERE coluna = :link AND.. OR..
     * @param STRING $ParseString = link={$link}&link2={$link2}
     */
    public function ExeUpdate($Tabela, array $Dados, $Termos, $ParseString) {
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;
        $this->Termos = (string) $Termos;

        parse_str($ParseString, $this->Places);
        $this->getSyntax();
        $this->Execute();
    }

    public function ExeUpdateColaborador($Tabela, array $Dados, $codColaborador) {

        $Conn = parent::getConn();

        $sql = "UPDATE " . $Tabela . " SET "
                    . " MATRICULA = ? " 
                    . " , STATUS = ? "
                    . " , DATA = SYSDATE "
                . " WHERE "
                    . " CODIGO  = " . $codColaborador;
        
        $matric = substr($Dados['MATRICULA'], 0 ,strrpos($Dados['MATRICULA'],'-'));
        
        $stmt = $Conn->prepare($sql);
        $stmt->bindParam(1, trim($matric), PDO::PARAM_INT, 10);
        $stmt->bindParam(7, $Dados['STATUS'], PDO::PARAM_INT, 10);

        $Conn->beginTransaction();
        $stmt->execute();
        $Conn->commit();
        
        $stmt = $Conn->prepare("DELETE FROM SITE_R_COLABORADOR_NIVEL WHERE COD_TERCEIRO = " . $codColaborador);
        $stmt->execute();
        $Conn->commit();
        
        if (isset($this->Dados['OPCAO1'])){
            $this->ExeCreateRColabNivel($this->Dados['CODIGO'], $this->Dados['OPCAO1']);
        }
        
        if (isset($this->Dados['OPCAO2'])){
            $this->ExeCreateRColabNivel($this->Dados['CODIGO'], $this->Dados['OPCAO2']);
        }

        if (isset($this->Dados['OPCAO3'])){
            $this->ExeCreateRColabNivel($this->Dados['CODIGO'], $this->Dados['OPCAO3']);
        }
        
        if (isset($this->Dados['OPCAO4'])){
            $this->ExeCreateRColabNivel($this->Dados['CODIGO'], $this->Dados['OPCAO4']);
        }

        if (isset($this->Dados['OPCAO5'])){
            $this->ExeCreateRColabNivel($this->Dados['CODIGO'], $this->Dados['OPCAO5']);
        }
        
        if (isset($this->Dados['OPCAO6'])){
            $this->ExeCreateRColabNivel($this->Dados['CODIGO'], $this->Dados['OPCAO6']);
        }

        if (isset($this->Dados['OPCAO7'])){
            $this->ExeCreateRColabNivel($this->Dados['CODIGO'], $this->Dados['OPCAO7']);
        }
        
        if (isset($this->Dados['OPCAO8'])){
            $this->ExeCreateRColabNivel($this->Dados['CODIGO'], $this->Dados['OPCAO8']);
        }

        if (isset($this->Dados['OPCAO9'])){
            $this->ExeCreateRColabNivel($this->Dados['CODIGO'], $this->Dados['OPCAO9']);
        }
        
        if (isset($this->Dados['OPCAO10'])){
            $this->ExeCreateRColabNivel($this->Dados['CODIGO'], $this->Dados['OPCAO10']);
        }
        
        if (isset($this->Dados['OPCAO11'])){
            $this->ExeCreateRColabNivel($this->Dados['CODIGO'], $this->Dados['OPCAO11']);
        }
        
        if (isset($this->Dados['OPCAO12'])){
            $this->ExeCreateRColabNivel($this->Dados['CODIGO'], $this->Dados['OPCAO12']);
        }
        
    }
    
    public function ExeUpdateTerceiro($Tabela, array $Dados, $codTerceiro) {

        $Conn = parent::getConn();

        $sql = "UPDATE " . $Tabela . " SET "
                    . " NOME = ? " 
                    . " , INSTITUICAO = ? "
                    . " , USUARIO = ? "
                    . " , EMAIL = ? "
                    . " , SENHA = ? "
                    . " , CLASSE = ? "
                    . " , STATUS = ? "
                    . " , DATA = SYSDATE "
                . " WHERE "
                    . " CODIGO  = " . $codTerceiro;
        
        $stmt = $Conn->prepare($sql);
        $stmt->bindParam(1, $Dados['NOME'], PDO::PARAM_STR, strlen($this->Dados['NOME']));
        $stmt->bindParam(2, $Dados['INSTITUICAO'], PDO::PARAM_STR, strlen($this->Dados['INSTITUICAO']));
        $stmt->bindParam(3, $Dados['USUARIO'], PDO::PARAM_STR, strlen($this->Dados['USUARIO']));
        $stmt->bindParam(4, $Dados['EMAIL'], PDO::PARAM_STR, strlen($this->Dados['EMAIL']));
        $stmt->bindParam(5, $Dados['SENHA'], PDO::PARAM_STR, strlen($this->Dados['SENHA']));
        $stmt->bindParam(6, $Dados['CLASSE'], PDO::PARAM_STR, strlen($this->Dados['CLASSE']));
        $stmt->bindParam(7, $Dados['STATUS'], PDO::PARAM_INT, 10);

        $Conn->beginTransaction();
        $stmt->execute();
        $Conn->commit();
        
        $stmt = $Conn->prepare("DELETE FROM SITE_R_TERCEIRO_NIVEL WHERE COD_TERCEIRO = " . $codTerceiro);
        $stmt->execute();
        $Conn->commit();
        
        if (isset($this->Dados['OPCAO1'])){
            $this->ExeCreateRTercNivel($this->Dados['CODIGO'], $this->Dados['OPCAO1']);
        }
        
        if (isset($this->Dados['OPCAO2'])){
            $this->ExeCreateRTercNivel($this->Dados['CODIGO'], $this->Dados['OPCAO2']);
        }

        if (isset($this->Dados['OPCAO3'])){
            $this->ExeCreateRTercNivel($this->Dados['CODIGO'], $this->Dados['OPCAO3']);
        }
        
        if (isset($this->Dados['OPCAO4'])){
            $this->ExeCreateRTercNivel($this->Dados['CODIGO'], $this->Dados['OPCAO4']);
        }

        if (isset($this->Dados['OPCAO5'])){
            $this->ExeCreateRTercNivel($this->Dados['CODIGO'], $this->Dados['OPCAO5']);
        }
        
        if (isset($this->Dados['OPCAO6'])){
            $this->ExeCreateRTercNivel($this->Dados['CODIGO'], $this->Dados['OPCAO6']);
        }

        if (isset($this->Dados['OPCAO7'])){
            $this->ExeCreateRTercNivel($this->Dados['CODIGO'], $this->Dados['OPCAO7']);
        }
        
        if (isset($this->Dados['OPCAO8'])){
            $this->ExeCreateRTercNivel($this->Dados['CODIGO'], $this->Dados['OPCAO8']);
        }

        if (isset($this->Dados['OPCAO9'])){
            $this->ExeCreateRTercNivel($this->Dados['CODIGO'], $this->Dados['OPCAO9']);
        }
        
        if (isset($this->Dados['OPCAO10'])){
            $this->ExeCreateRTercNivel($this->Dados['CODIGO'], $this->Dados['OPCAO10']);
        }
        
        if (isset($this->Dados['OPCAO11'])){
            $this->ExeCreateRTercNivel($this->Dados['CODIGO'], $this->Dados['OPCAO11']);
        }
        
        if (isset($this->Dados['OPCAO12'])){
            $this->ExeCreateRTercNivel($this->Dados['CODIGO'], $this->Dados['OPCAO12']);
        }
        
    }
    
    public function ExeCreateRTercNivel($codigo, $opcao) {
        
        $Conn = parent::getConn();
        
        $sql = "INSERT INTO SITE_R_TERCEIRO_NIVEL (COD_TERCEIRO, COD_NIVEL) VALUES ( ?, ?)";

        $stmt = $Conn->prepare($sql);
        $stmt->bindParam(1, $codigo, PDO::PARAM_INT, 32);
        $stmt->bindParam(2, $opcao, PDO::PARAM_INT, 32);

        $Conn->beginTransaction();
        $stmt->execute();
        $Conn->commit();
        
    }
    
    public function ExeCreateRColabNivel($codigo, $opcao) {
        
        $Conn = parent::getConn();
        
        $sql = "INSERT INTO SITE_R_COLABORADOR_NIVEL (COD_TERCEIRO, COD_NIVEL) VALUES ( ?, ?)";

        $stmt = $Conn->prepare($sql);
        $stmt->bindParam(1, $codigo, PDO::PARAM_INT, 32);
        $stmt->bindParam(2, $opcao, PDO::PARAM_INT, 32);

        $Conn->beginTransaction();
        $stmt->execute();
        $Conn->commit();
        
    }
    
    public function ExeUpdateNoticia($Tabela, array $Dados, $idNoticia) {
        
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;

        $Conn = parent::getConn();

        $sql = "UPDATE {$this->Tabela} SET CODIGO = ?, TITULO = ?, STATUS = ?, CONTEUDO = ?, CAPA = ?, DATA = SYSDATE WHERE CODIGO = {$idNoticia}";

        $stmt = $Conn->prepare($sql);
        $stmt->bindParam(1, $this->Dados['CODIGO'], PDO::PARAM_INT, 32);
        $stmt->bindParam(2, $this->Dados['TITULO'], PDO::PARAM_STR, strlen($this->Dados['TITULO']));
        $stmt->bindParam(3, $this->Dados['STATUS'], PDO::PARAM_INT, 32);
        $stmt->bindParam(4, $this->Dados['CONTEUDO'], PDO::PARAM_STR, strlen($this->Dados['CONTEUDO']));
        $stmt->bindParam(5, $this->Dados['CAPA'], PDO::PARAM_INT, 70);

        $Conn->beginTransaction();
        $stmt->execute();
        $Conn->commit();
        
    }
    
    public function ExeUpdateVaga($Tabela, array $Dados, $idVaga) {
        
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;

        $Conn = parent::getConn();

        $sql = "UPDATE {$this->Tabela} SET CODIGO = ?, DESCRICAO = ?, QTDE = ?, DESCRITIVO = ?, TIPO = ?, DATA = SYSDATE WHERE CODIGO = {$idVaga}";

        $stmt = $Conn->prepare($sql);
        $stmt->bindParam(1, $this->Dados['CODIGO'], PDO::PARAM_INT, 32);
        $stmt->bindParam(2, $this->Dados['DESCRICAO'], PDO::PARAM_STR, strlen($this->Dados['DESCRICAO']));
        $stmt->bindParam(3, $this->Dados['QTDE'], PDO::PARAM_INT, 32);
        $stmt->bindParam(4, $this->Dados['DESCRITIVO'], PDO::PARAM_STR, strlen($this->Dados['DESCRITIVO']));
        $stmt->bindParam(5, $this->Dados['TIPO'], PDO::PARAM_INT, 32);

        $Conn->beginTransaction();
        $stmt->execute();
        $Conn->commit();
        
    }
    
    
    /**
     * <b>Obter resultado:</b> Retorna TRUE se não ocorrer erros, ou FALSE. Mesmo não alterando os dados se uma query
     * for executada com sucesso o retorno será TRUE. Para verificar alterações execute o getRowCount();
     * @return BOOL $Var = True ou False
     */
    public function getResult() {
        return $this->Result;
    }

    /**
     * <b>Contar Registros: </b> Retorna o número de linhas alteradas no banco!
     * @return INT $Var = Quantidade de linhas alteradas
     */
    public function getRowCount() {
        return $this->Update->rowCount();
    }

    /**
     * <b>Modificar Links:</b> Método pode ser usado para atualizar com Stored Procedures. Modificando apenas os valores
     * da condição. Use este método para editar múltiplas linhas!
     * @param STRING $ParseString = id={$id}&..
     */
    public function setPlaces($ParseString) {
        parse_str($ParseString, $this->Places);
        $this->getSyntax();
        $this->Execute();
    }

    /**
     * ****************************************
     * *********** PRIVATE METHODS ************
     * ****************************************
     */
    //Obtém o PDO e Prepara a query
    private function Connect() {
        $this->Conn = parent::getConn();
        $this->Update = $this->Conn->prepare($this->Update);
    }

    //Cria a sintaxe da query para Prepared Statements
    private function getSyntax() {
        foreach ($this->Dados as $Key => $Value):
            $Places[] = $Key . ' = :' . $Key;
        endforeach;
        $Places = implode(', ', $Places);
        $this->Update = "UPDATE {$this->Tabela} SET {$Places} {$this->Termos}";
        //if ($this->Tabela == 'SITE_CATEGORIA_RELATORIO'):
            $this->Update = str_replace(":DATA", "TO_DATE(:DATA, 'DD/MM/YYYY HH24:MI:SS')", $this->Update);
        //endif;
    }

    //Obtém a Conexão e a Syntax, executa a query!
    private function Execute() {
        $this->Connect();
        try {
            $this->Update->execute(array_merge($this->Dados, $this->Places));
            $this->Result = true;
        } catch (PDOException $e) {
            $this->Result = null;
            WSErro("<b>Erro ao Ler:</b> {$e->getMessage()}", $e->getCode());
        }
    }

}
