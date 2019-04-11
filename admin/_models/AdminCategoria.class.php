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
    private $idDocumento;
    private $error;
    public $result;

    const Entity = 'SITE_CATEGORIA_RELATORIO';
    const SegEntity = 'SITE_RELATORIO';

    public function ExeCreate(array $dado) {
        $this->dado = $dado;

        if ($this->dado['CODPARENTE'] == 0):
            $this->dado['NIVEL'] = 1;
        else:
            $read = new Read;
            $read->ExeReadMod("SELECT * FROM SITE_CATEGORIA_RELATORIO WHERE CODIGO =  {$this->dado['CODPARENTE']}");
            foreach ($read->getResult() as $categ):
                $this->dado['NIVEL'] = $categ['NIVEL'] + 1;
            endforeach;
        endif;

        $this->Create();
    }

    public function ExeUpdate($idCategoria, array $dado) {
        $this->idCategoria = (int) $idCategoria;
        $this->dado = $dado;
        $this->Update();
    }

    public function ExeDelete($idCategoria) {
        $this->idCategoria = (int) $idCategoria;
        $this->Delete();
        $this->DelDoc($this->idCategoria);
        $readSubNivel = new Read;
        $readSubNivel->ExeReadMod("SELECT * FROM SITE_CATEGORIA_RELATORIO WHERE CODPARENTE =  {$idCategoria}");
        if ($readSubNivel->getResult()):
            foreach ($readSubNivel->getResult() as $categSubNivel):
                $this->idCategoria = $categSubNivel['CODIGO'];
                $this->Delete();
                $this->DelDoc($this->idCategoria);
                $readSubSubNivel = new Read;
                $readSubSubNivel->ExeReadMod("SELECT * FROM SITE_CATEGORIA_RELATORIO WHERE CODPARENTE =  {$idCategoria}");
                if ($readSubSubNivel->getResult()):
                    foreach ($readSubSubNivel->getResult() as $categSubSubNivel):
                        $this->idCategoria = $categSubSubNivel['CODIGO'];
                        $this->Delete();
                        $this->DelDoc($this->idCategoria);
                    endforeach;
                endif;
            endforeach;
        endif;
    }

    private function Create() {
        $cadastra = new Create;
        $cadastra->ExeCreate(self::Entity, $this->dado);
        if ($cadastra->getResult()):
            $this->result = $cadastra->getResult();
        endif;
    }

    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->dado, "WHERE CODIGO = :CODIGO", "CODIGO={$this->idCategoria}");
    }

    private function Delete() {
        $Delete = new Delete;
        $Delete->ExeDelete(self::Entity, "WHERE CODIGO = :CODIGO", "CODIGO={$this->idCategoria}");
    }

    private function DeleteDoc() {
        $Delete = new Delete;
        $Delete->ExeDelete(self::SegEntity, "WHERE CODIGO = :CODIGO", "CODIGO={$this->idDocumento}");
    }

    public function DelDoc($idCategoria) {

        $readDoc = new Read;
        $readDoc->ExeRead(self::SegEntity, "WHERE SECAO = :SECAO", "SECAO={$idCategoria}");

        if ($readDoc->getResult()):
            foreach ($readDoc->getResult() as $dados):
                extract($dados);
                $localDoc = '../uploads/' . $DOCUMENTO;
                if (file_exists($localDoc) && !is_dir($localDoc)):
                    unlink($localDoc);
                endif;
                $this->idDocumento = $CODIGO;
                $this->DeleteDoc();
            endforeach;
        endif;
    }
    
    public function DownSecao($idCategoria) {

        $readDoc = new Read;
        $readDoc->ExeRead(self::Entity, "WHERE CODIGO = :CODIGO", "CODIGO={$idCategoria}");

        foreach ($readDoc->getResult() as $dados):
            $readDocSecao = new Read;
            $readDocSecao->ExeReadMod("SELECT * FROM SITE_CATEGORIA_RELATORIO WHERE CODPARENTE = {$dados['CODPARENTE']} AND TIPO = {$dados['TIPO']} ORDER BY POSICAO DESC");
            foreach ($readDocSecao->getResult() as $dadosSecao):
                if ($dadosSecao['POSICAO'] < $dados['POSICAO']):
                    $d = array("POSICAO" => $dadosSecao['POSICAO']);
                    $this->ExeUpdate($dados['CODIGO'], $d);
                    $d = array("POSICAO" => $dados['POSICAO']);
                    $this->ExeUpdate($dadosSecao['CODIGO'], $d);
                    break;
                endif;
            endforeach;
        endforeach;
    }

    public function UpSecao($idCategoria) {

        $readDoc = new Read;
        $readDoc->ExeRead(self::Entity, "WHERE CODIGO = :CODIGO", "CODIGO={$idCategoria}");

        foreach ($readDoc->getResult() as $dados):
            $readDocSecao = new Read;
            $readDocSecao->ExeReadMod("SELECT * FROM SITE_CATEGORIA_RELATORIO WHERE CODPARENTE = {$dados['CODPARENTE']} AND TIPO = {$dados['TIPO']} ORDER BY POSICAO ASC");
            foreach ($readDocSecao->getResult() as $dadosSecao):
                if ($dadosSecao['POSICAO'] > $dados['POSICAO']):
                    $d = array("POSICAO" => $dadosSecao['POSICAO']);
                    $this->ExeUpdate($dados['CODIGO'], $d);
                    $d = array("POSICAO" => $dados['POSICAO']);
                    $this->ExeUpdate($dadosSecao['CODIGO'], $d);
                    break;
                endif;
            endforeach;
        endforeach;
    }

}
