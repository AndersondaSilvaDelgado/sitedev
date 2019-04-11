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
class AdminPoliticaRH {

    //put your code here

    private $dado;
    private $idPolitica;
    private $error;
    private $result;

    const Entity = 'SITE_POLITICAS_RH_NV';

    public function ExeCreate(array $dado) {

        $nomeDocumento = 'usf_politicas_rh_' . str_pad($dado['CODIGO'], 4, "0", STR_PAD_LEFT) . '_ano_' . date('Y') . '.pdf';
        $pasta = 'politicasrh';

        $upload = new Upload;
        $upload->File($dado['DOCUMENTO'], $nomeDocumento, $pasta);

        $dado['DOCUMENTO'] = $pasta . '/' . $nomeDocumento;

        $this->dado = $dado;
        $this->Create();
    }

    public function ExeUpdate($idPolitica, array $dado) {

        if ($dado['DOCUMENTO'] != 'null'):

            $readDoc = new Read;
            $readDoc->ExeRead(self::Entity, "WHERE CODIGO = :CODIGO", "CODIGO={$idPolitica}");

            foreach ($readDoc->getResult() as $dados):
                extract($dados);
                $localDoc = '../uploads/' . $DOCUMENTO;
                if (file_exists($localDoc) && !is_dir($localDoc)):
                    unlink($localDoc);
                endif;
            endforeach;

            $nomeDocumento = 'usf_politicas_rh_' . str_pad($dado['CODIGO'], 4, "0", STR_PAD_LEFT) . '_ano_' . date('Y') . '.pdf';
            $pasta = 'politicasrh';

            $upload = new Upload;
            $upload->File($dado['DOCUMENTO'], $nomeDocumento, $pasta);
            $dado['DOCUMENTO'] = $pasta . '/' . $nomeDocumento;

        else:
            unset($dado['DOCUMENTO']);
        endif;

        $this->idPolitica = (int) $idPolitica;
        $this->dado = $dado;
        $this->Update();
    }

    public function ExeUpdatePos($idPolitica, array $dado) {

        $this->idPolitica = (int) $idPolitica;
        $this->dado = $dado;
        $this->Update();
    }

    public function ExeDelete($idPolitica) {

        $this->idPolitica = (int) $idPolitica;

        $readDoc = new Read;
        $readDoc->ExeRead(self::Entity, "WHERE CODIGO = :CODIGO", "CODIGO={$idPolitica}");

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
        $Update->ExeUpdate(self::Entity, $this->dado, "WHERE CODIGO = :CODIGO", "CODIGO={$this->idPolitica}");
    }

    private function Delete() {
        $Delete = new Delete;
        $Delete->ExeDelete(self::Entity, "WHERE CODIGO = :CODIGO", "CODIGO={$this->idPolitica}");
    }

    public function DownDoc($idPolitica) {

        $this->idPolitica = (int) $idPolitica;

        $readDoc = new Read;
        $readDoc->ExeRead(self::Entity, "WHERE CODIGO = :CODIGO", "CODIGO={$idPolitica}");

        foreach ($readDoc->getResult() as $dados):
            $readDocSecao = new Read;
            $readDocSecao->ExeReadMod("SELECT * FROM SITE_POLITICAS_RH ORDER BY POSICAO DESC");
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

    public function UpDoc($idPolitica) {

        $this->idPolitica = (int) $idPolitica;

        $readDoc = new Read;
        $readDoc->ExeRead(self::Entity, "WHERE CODIGO = :CODIGO", "CODIGO={$idPolitica}");

        foreach ($readDoc->getResult() as $dados):
            $readDocSecao = new Read;
            $readDocSecao->ExeReadMod("SELECT * FROM SITE_POLITICAS_RH ORDER BY POSICAO ASC");
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
