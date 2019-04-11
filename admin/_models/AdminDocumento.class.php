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

    //put your code here

    private $dado;
    private $idDocumento;
    private $error;
    private $result;

    const Entity = 'SITE_RELATORIO';

    public function ExeCreate(array $dado) {

        $nomeDocumento = 'usf_doc_' . str_pad($dado['CODIGO'], 4, "0", STR_PAD_LEFT) . '_ano_' . date('Y') . '.pdf';
        $pasta = 'documento';

//        var_dump($dado['DOCUMENTO']);

        $upload = new Upload;
        $upload->File($dado['DOCUMENTO'], $nomeDocumento, $pasta);

        $dado['DOCUMENTO'] = $pasta . '/' . $nomeDocumento;

        $this->dado = $dado;
        $this->Create();
    }

    public function ExeUpdate($idDocumento, array $dado) {

        if ($dado['DOCUMENTO'] != 'null'):

            $readDoc = new Read;
            $readDoc->ExeRead(self::Entity, "WHERE CODIGO = :CODIGO", "CODIGO={$idDocumento}");

            foreach ($readDoc->getResult() as $dados):
                extract($dados);
                $localDoc = '../uploads/' . $DOCUMENTO;
                if (file_exists($localDoc) && !is_dir($localDoc)):
                    unlink($localDoc);
                endif;
            endforeach;

            $nomeDocumento = 'usf_doc_' . str_pad($dado['CODIGO'], 4, "0", STR_PAD_LEFT) . '_ano_' . date('Y') . '.pdf';
            $pasta = 'documento';

            $upload = new Upload;
            $upload->File($dado['DOCUMENTO'], $nomeDocumento, $pasta);
            $dado['DOCUMENTO'] = $pasta . '/' . $nomeDocumento;

        else:
            unset($dado['DOCUMENTO']);
        endif;

        $this->idDocumento = (int) $idDocumento;
        $this->dado = $dado;
        $this->Update();
    }

    public function ExeUpdatePos($idDocumento, array $dado) {

        $this->idDocumento = (int) $idDocumento;
        $this->dado = $dado;
        $this->Update();
    }

    public function ExeDelete($idCategoria) {

        $this->idDocumento = (int) $idCategoria;

        $readDoc = new Read;
        $readDoc->ExeRead(self::Entity, "WHERE CODIGO = :CODIGO", "CODIGO={$idNoticia}");

        foreach ($readDoc->getResult() as $dados):
            extract($dados);
            $localDoc = '../uploads/' . $DOCUMENTO;
            if (file_exists($localDoc) && !is_dir($localDoc)):
                unlink($localDoc);
            endif;
        endforeach;

        $this->Delete();
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
        $Update->ExeUpdate(self::Entity, $this->dado, "WHERE CODIGO = :CODIGO", "CODIGO={$this->idDocumento}");
    }

    private function Delete() {
        $Delete = new Delete;
        $Delete->ExeDelete(self::Entity, "WHERE CODIGO = :CODIGO", "CODIGO={$this->idDocumento}");
    }

    public function DelSecao($idCategoria) {

        $readDoc = new Read;
        $readDoc->ExeRead(self::Entity, "WHERE SECAO = :SECAO", "SECAO={$idCategoria}");

        foreach ($readDoc->getResult() as $dados):
            extract($dados);
            $localDoc = '../uploads/' . $DOCUMENTO;
            if (file_exists($localDoc) && !is_dir($localDoc)):
                unlink($localDoc);
            endif;
            $this->idDocumento = $CODIGO;
            $this->Delete();
        endforeach;
    }

    public function DownDoc($idDocumento) {

        $this->idDocumento = (int) $idDocumento;

        $readDoc = new Read;
        $readDoc->ExeRead(self::Entity, "WHERE CODIGO = :CODIGO", "CODIGO={$idDocumento}");

        foreach ($readDoc->getResult() as $dados):
            $readDocSecao = new Read;
            $readDocSecao->ExeReadMod("SELECT * FROM SITE_RELATORIO WHERE SECAO = {$dados['SECAO']} ORDER BY POSICAO DESC");
            foreach ($readDocSecao->getResult() as $dadosSecao):
                if ($dadosSecao['POSICAO'] < $dados['POSICAO']):
                    $d = array("POSICAO" => $dadosSecao['POSICAO']);
                    $this->ExeUpdatePos($dados['CODIGO'], $d);
                    $d = array("POSICAO" => $dados['POSICAO']);
                    $this->ExeUpdatePos($dadosSecao['CODIGO'], $d);
                    break;
                endif;
            endforeach;
        endforeach;
    }

    public function UpDoc($idDocumento) {

        $this->idDocumento = (int) $idDocumento;

        $readDoc = new Read;
        $readDoc->ExeRead(self::Entity, "WHERE CODIGO = :CODIGO", "CODIGO={$idDocumento}");

        foreach ($readDoc->getResult() as $dados):
            $readDocSecao = new Read;
            $readDocSecao->ExeReadMod("SELECT * FROM SITE_RELATORIO WHERE SECAO = {$dados['SECAO']} ORDER BY POSICAO ASC");
            foreach ($readDocSecao->getResult() as $dadosSecao):
                if ($dadosSecao['POSICAO'] > $dados['POSICAO']):
                    $d = array("POSICAO" => $dadosSecao['POSICAO']);
                    $this->ExeUpdatePos($dados['CODIGO'], $d);
                    $d = array("POSICAO" => $dados['POSICAO']);
                    $this->ExeUpdatePos($dadosSecao['CODIGO'], $d);
                    break;
                endif;
            endforeach;
        endforeach;
    }

}
