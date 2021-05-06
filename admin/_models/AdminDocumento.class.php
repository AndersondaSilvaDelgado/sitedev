<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminDocumento
 *
 * @author anderson
 */
class AdminDocumento {

    private $dado;
    private $idDocumento;
    private $error;
    private $result;
    
    private function Tabela($tipo){
        $bancoDoc = '';
        if($tipo == 1){
            $bancoDoc = 'SITE_DOC_DEMO_FINANC';
        }
        else if($tipo == 2){
            $bancoDoc = 'SITE_DOC_GOVERNANCA';
        }
        else if($tipo == 3){
            $bancoDoc = 'SITE_DOC_JURIDICO';
        }
        else if($tipo == 4){
            $bancoDoc = 'SITE_DOC_PORTAL_GOV';
        }
        return $bancoDoc;
    }
    
    private function Pasta($tipo){
        $pasta = '';
        if($tipo == 1){
            $pasta = 'docdemofinanc';
        }
        else if($tipo == 2){
            $pasta = 'docgovernanca';
        }
        else if($tipo == 3){
            $pasta = 'docjuridico';
        }
        else if($tipo == 4){
            $pasta = 'docportalgov';
        }
        return $pasta;
    }
    

    public function Read($tipo, $codigo = null) {
        
        $read = new Read;
        if (!empty($codigo)){
            return $read->ExeRead($this->Tabela($tipo), "WHERE CODIGO = :CODIGO", "CODIGO={$codigo}");
        }
        else{
            return $read->ExeRead($this->Tabela($tipo), "ORDER BY POSICAO DESC");
        }
        
    }
    
    public function ExeCreate(array $dado, $tipo) {

        $nomeDocumento = 'usf_doc_' . str_pad($dado['CODIGO'], 4, "0", STR_PAD_LEFT) . '_ano_' . date('Y') . '.pdf';
        $pasta = $this->Pasta($tipo);

        $upload = new Upload;
        $upload->File($dado['DOCUMENTO'], $nomeDocumento, $pasta);

        $dado['DOCUMENTO'] = $pasta . '/' . $nomeDocumento;

        $this->dado = $dado;
        $this->Create($tipo);
        
    }

    public function ExeUpdate($idDocumento, array $dado, $tipo) {

        if ($dado['DOCUMENTO'] != 'null'){

            $readDoc = new Read;
            $readDoc->ExeRead($this->Tabela($tipo), "WHERE CODIGO = :CODIGO", "CODIGO={$idDocumento}");

            foreach ($readDoc->getResult() as $dados){
                $localDoc = '../uploads/' . $dados['DOCUMENTO'];
                if (file_exists($localDoc) && !is_dir($localDoc)){
                    unlink($localDoc);
                }
            }

            $nomeDocumento = 'usf_doc_' . str_pad($dado['CODIGO'], 4, "0", STR_PAD_LEFT) . '_ano_' . date('Y') . '.pdf';
            $pasta = $this->Pasta($tipo);

            $upload = new Upload;
            $upload->File($dado['DOCUMENTO'], $nomeDocumento, $pasta);
            $dado['DOCUMENTO'] = $pasta . '/' . $nomeDocumento;
            
        }
        else{
            unset($dado['DOCUMENTO']);
        }

        $this->idDocumento = (int) $idDocumento;
        $this->dado = $dado;
        $this->Update($tipo);
        
    }

    public function ExeUpdatePos($idDocumento, array $dado, $tipo) {

        $this->idDocumento = (int) $idDocumento;
        $this->dado = $dado;
        $this->Update($tipo);
        
    }

    public function ExeDelete($idCategoria, $tipo) {

        $this->idDocumento = (int) $idCategoria;

        $readDoc = new Read;
        $readDoc->ExeRead($this->Tabela($tipo), "WHERE CODIGO = :CODIGO", "CODIGO={$idCategoria}");

        foreach ($readDoc->getResult() as $dados){
            $localDoc = '../uploads/' . $dados['DOCUMENTO'];
            if (file_exists($localDoc) && !is_dir($localDoc)){
                unlink($localDoc);
            }
        }

        $this->Delete($tipo);
        
    }

    private function Create($tipo) {
        
        $create = new Create;
        $create->ExeCreate($this->Tabela($tipo), $this->dado);
        
        if ($create->getResult()){
            $this->result = $create->getResult();
        }
        
    }

    private function Update($tipo) {
        $Update = new Update;
        $Update->ExeUpdate($this->Tabela($tipo), $this->dado, "WHERE CODIGO = :CODIGO", "CODIGO={$this->idDocumento}");
    }

    private function Delete($tipo) {
        $Delete = new Delete;
        $Delete->ExeDelete($this->Tabela($tipo), "WHERE CODIGO = :CODIGO", "CODIGO={$this->idDocumento}");
    }

    public function DeleteSecao($idCategoria, $tipo) {

        $read = new Read;
        $read->ExeRead($this->Tabela($tipo), "WHERE SECAO = :SECAO", "SECAO={$idCategoria}");

        foreach ($read->getResult() as $dados){
            $localDoc = '../uploads/' . $dados['DOCUMENTO'];
            if (file_exists($localDoc) && !is_dir($localDoc)){
                unlink($localDoc);
            }
            $this->idDocumento = $dados['CODIGO'];
            $this->Delete($tipo);
        }
        
    }

    public function DownDoc($idDocumento, $tipo) {

        $this->idDocumento = (int) $idDocumento;

        $readDoc = new Read;
        $readDoc->ExeRead($this->Tabela($tipo), "WHERE CODIGO = :CODIGO", "CODIGO={$idDocumento}");

        foreach ($readDoc->getResult() as $dados){
            
            $readDocSecao = new Read;
            $readDocSecao->ExeRead($this->Tabela($tipo), "WHERE SECAO = :SECAO ORDER BY POSICAO DESC", "SECAO={$dados['SECAO']}");
            
            foreach ($readDocSecao->getResult() as $dadosSecao){
                
                if ($dadosSecao['POSICAO'] < $dados['POSICAO']){
                    
                    $d1 = array("POSICAO" => $dadosSecao['POSICAO']);
                    $this->ExeUpdatePos($dados['CODIGO'], $d1);
                    $d2 = array("POSICAO" => $dados['POSICAO']);
                    $this->ExeUpdatePos($dadosSecao['CODIGO'], $d2);
                    break;
                    
                }
                
            }
            
        }
        
    }

    public function UpDoc($idDocumento, $tipo) {

        $this->idDocumento = (int) $idDocumento;

        $readDoc = new Read;
        $readDoc->ExeRead($this->Tabela($tipo), "WHERE CODIGO = :CODIGO", "CODIGO={$idDocumento}");

        foreach ($readDoc->getResult() as $dados){
            
            $readDocSecao = new Read;
            $readDocSecao->ExeRead($this->Tabela($tipo), " WHERE SECAO = :SECAO ORDER BY POSICAO ASC", "SECAO={$dados['SECAO']}");
            
            foreach ($readDocSecao->getResult() as $dadosSecao){
                
                if ($dadosSecao['POSICAO'] > $dados['POSICAO']){
                    
                    $d1 = array("POSICAO" => $dadosSecao['POSICAO']);
                    $this->ExeUpdatePos($dados['CODIGO'], $d1);
                    $d2 = array("POSICAO" => $dados['POSICAO']);
                    $this->ExeUpdatePos($dadosSecao['CODIGO'], $d2);
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
