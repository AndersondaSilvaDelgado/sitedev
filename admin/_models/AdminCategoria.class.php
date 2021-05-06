<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminNoticia
 *
 * @author anderson
 */
class AdminCategoria {

    //put your code here

    private $dado;
    private $idCategoria;
    public $result;

    private function Tipo($tipo){
        $bancoCateg = '';
        if($tipo == 1){
            $bancoCateg = 'SITE_CATEG_DEMO_FINANC';
        }
        else if($tipo == 2){
            $bancoCateg = 'SITE_CATEG_GOVERNANCA';
        }
        else if($tipo == 3){
            $bancoCateg = 'SITE_CATEG_JURIDICO';
        }
        else if($tipo == 4){
            $bancoCateg = 'SITE_CATEG_PORTAL_GOV';
        }
        return $bancoCateg;
    }
    
    public function ReadCod($tipo, $codigo) {
        
        $read = new Read;
        return $read->ExeRead($this->Tipo($tipo), "WHERE CODIGO = :CODIGO", "CODIGO={$codigo}");
        
    }
    
    public function ReadNivel($tipo, $nivel, $codparente = null) {
        
        $read = new Read;
        $where = '';
        if (!empty($codparente)){
            return $read->ExeRead($this->Tipo($tipo), "WHERE NIVEL = :NIVEL ORDER BY POSICAO DESC", "NIVEL={$nivel}");
        }
        else{
            return $read->ExeRead($this->Tipo($tipo), "WHERE NIVEL = :NIVEL AND CODPARENTE = :CODPARENTE ORDER BY POSICAO DESC", "NIVEL={$nivel}&CODPARENTE={$codparente}");
        }
        
    }
    
    public function ExeCreate(array $dado, $tipo) {
        
        $this->dado = $dado;
        
        if ($this->dado['CODPARENTE'] == 0){
            $this->dado['NIVEL'] = 1;
        }
        else{
            $read = new Read;
            $read->ExeRead($this->Tipo($tipo), "WHERE CODIGO = :CODIGO", "CODIGO={$this->dado['CODPARENTE']}");
            foreach ($read->getResult() as $categ){
                $this->dado['NIVEL'] = $categ['NIVEL'] + 1;
            }
        }

        $this->Create($tipo);
        
    }

    public function ExeUpdate($idCategoria, array $dado, $tipo) {
        $this->idCategoria = (int) $idCategoria;
        $this->dado = $dado;
        $this->Update($tipo);
    }

    public function ExeDelete($idCategoria, $tipo) {
        
        $this->idCategoria = (int) $idCategoria;
        $this->Delete($tipo);
        
        $adminDocumento = new AdminDocumento();
        $adminDocumento->DeleteSecao($this->idCategoria);
        
        $readSubNivel = new Read;
        $readSubNivel->ExeRead($this->Tipo($tipo), "WHERE CODPARENTE = :CODPARENTE", "CODPARENTE={$idCategoria}");
        
        if ($readSubNivel->getResult()){
            
            foreach ($readSubNivel->getResult() as $categSubNivel){
                
                $this->idCategoria = $categSubNivel['CODIGO'];
                $this->Delete($tipo);
                $adminDocumento->DeleteSecao($this->idCategoria);
                $readSubSubNivel = new Read;
                $readSubSubNivel->ExeReadMod($this->Tipo($tipo), "WHERE CODPARENTE = :CODPARENTE", "CODPARENTE={$idCategoria}");
                
                if ($readSubSubNivel->getResult()){
                    
                    foreach ($readSubSubNivel->getResult() as $categSubSubNivel){
                        $this->idCategoria = $categSubSubNivel['CODIGO'];
                        $this->Delete($tipo);
                        $adminDocumento->DeleteSecao($this->idCategoria);
                    }
                    
                }
                
            }
            
        }
    }

    private function Create($tipo) {
        $cadastra = new Create;
        $cadastra->ExeCreate($this->Tipo($tipo), $this->dado);
        if ($cadastra->getResult()){
            $this->result = $cadastra->getResult();
        }
    }

    private function Update($tipo) {
        $Update = new Update;
        $Update->ExeUpdate($this->Tipo($tipo), $this->dado, "WHERE CODIGO = :CODIGO", "CODIGO={$this->idCategoria}");
    }

    private function Delete($tipo) {
        $Delete = new Delete;
        $Delete->ExeDelete($this->Tipo($tipo), "WHERE CODIGO = :CODIGO", "CODIGO={$this->idCategoria}");
    }
    
    public function DownSecao($idCategoria, $tipo) {

        $readDoc = new Read;
        $readDoc->ExeRead($this->Tipo($tipo), "WHERE CODIGO = :CODIGO", "CODIGO={$idCategoria}");

        foreach ($readDoc->getResult() as $dados){
            $readDocSecao = new Read;
            $readDocSecao->ExeRead($this->Tipo($tipo), "WHERE CODPARENTE = :CODPARENTE AND NIVEL = :NIVEL ORDER BY POSICAO DESC", "CODPARENTE={$dados['CODPARENTE']}&NIVEL={$dados['NIVEL']}");
            foreach ($readDocSecao->getResult() as $dadosSecao){
                if ($dadosSecao['POSICAO'] < $dados['POSICAO']){
                    $d1 = array("POSICAO" => $dadosSecao['POSICAO']);
                    $this->ExeUpdate($dados['CODIGO'], $d1);
                    $d2 = array("POSICAO" => $dados['POSICAO']);
                    $this->ExeUpdate($dadosSecao['CODIGO'], $d2);
                    break;
                }
            }
        }
    }

    public function UpSecao($idCategoria, $tipo) {

        $readDoc = new Read;
        $readDoc->ExeRead($this->Tipo($tipo), "WHERE CODIGO = :CODIGO", "CODIGO={$idCategoria}");

        foreach ($readDoc->getResult() as $dados){
            $readDocSecao = new Read;
            $readDocSecao->ExeRead($this->Tipo($tipo), "WHERE CODPARENTE = :CODPARENTE AND NIVEL = :NIVEL ORDER BY POSICAO ASC", "CODPARENTE={$dados['CODPARENTE']}&NIVEL={$dados['NIVEL']}");
            foreach ($readDocSecao->getResult() as $dadosSecao){
                if ($dadosSecao['POSICAO'] > $dados['POSICAO']){
                    $d1 = array("POSICAO" => $dadosSecao['POSICAO']);
                    $this->ExeUpdate($dados['CODIGO'], $d1);
                    $d2 = array("POSICAO" => $dados['POSICAO']);
                    $this->ExeUpdate($dadosSecao['CODIGO'], $d2);
                    break;
                }
            }
        }
    }

    public function Sequencia($tipo) {
        
        $read = new Read;
        $read->ExeReadMod("SELECT MAX(CODIGO) AS CODIGO "
                . " FROM {$this->Tabela($tipo)}");

        if ($read->getResult()){
            foreach ($read->getResult() as $doc){
                return ($doc['CODIGO'] + 1);
            }
        }
        else{
            return 1;
        }
        
    }
    
    public function Posicao($tipo) {
        
        $read = new Read;
        $read->ExeReadMod("SELECT MAX(POSICAO) AS POSICAO "
                . " FROM {$this->Tabela($tipo)}");

        if ($read->getResult()){
            foreach ($read->getResult() as $doc){
                return ($doc['POSICAO'] + 1);
            }
        }
        else{
            return 1;
        }
        
    }
    
}
