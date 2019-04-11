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
class AdminNoticia {

    //put your code here

    private $data;
    private $idNoticia;
    private $idFoto;
    private $error;
    private $result;

    const Entity = 'SITE_NOTICIAS';
    const EntityAux = 'SITE_NOTICIA_GALERIA';

    public function ExeCreate(array $dado) {

        $pasta = 'foto';
        $count = count($dado['fotos_galeria']['tmp_name']);
        $codFoto = 0;

        if (($count > 0) && ($dado['fotos_galeria']['tmp_name'][0] != '')):

            $read = new Read;
            $read->ExeReadMod('SELECT MAX(CODIGO) AS CODIGO FROM SITE_NOTICIA_GALERIA WHERE COD_NOTICIA = ' . $dado['CODIGO']);

            if ($read->getResult()):

                foreach ($read->getResult() as $fotos):
                    extract($fotos);
                    $codFoto = $CODIGO + 1;
                endforeach;

            endif;

            $files = array();
            $listTipo = array_keys($dado['fotos_galeria']);

            for ($i = 0; $i < $count; $i++):
                foreach ($listTipo as $t):
                    $files[$i][$t] = $dado['fotos_galeria'][$t][$i];
                endforeach;
            endfor;

            foreach ($files as $arqUpload):

                $upload = new Upload;
                $nomeDocumento = 'usf_foto_' . str_pad($dado['CODIGO'], 4, "0", STR_PAD_LEFT) . '_ano_' . date('Y') . '_' . str_pad($codFoto, 4, "0", STR_PAD_LEFT) . '.jpg';
                $upload->Image($arqUpload, $nomeDocumento, $pasta);

                $dadosFoto = array("CODIGO" => $codFoto,
                    "COD_NOTICIA" => $dado['CODIGO'],
                    "LINK" => $pasta . '/' . $nomeDocumento
                );
                $this->CreateFoto($dadosFoto);
                $codFoto++;
            endforeach;

        endif;

        $upload = new Upload;
        $nomeDocumento = 'usf_foto_' . str_pad($dado['CODIGO'], 4, "0", STR_PAD_LEFT) . '_ano_' . date('Y') . '.jpg';
        $upload->Image($dado['CAPA'], $nomeDocumento, $pasta);

        unset($dado['fotos_galeria']);
        $dado['CAPA'] = $pasta . '/' . $nomeDocumento;
        $this->data = $dado;
        $this->Create();
    }

    public function ExeUpdate($idNoticia, array $dado) {

        $pasta = 'foto';
        $count = count($dado['fotos_galeria']['tmp_name']);
        $codFoto = 0;

        if (($count > 0) && ($dado['fotos_galeria']['tmp_name'][0] != '')):

            $read = new Read;
            $read->ExeReadMod('SELECT MAX(CODIGO) AS CODIGO FROM SITE_NOTICIA_GALERIA WHERE COD_NOTICIA = ' . $dado['CODIGO']);

            if ($read->getResult()):

                foreach ($read->getResult() as $fotos):
                    extract($fotos);
                    $codFoto = $CODIGO + 1;
                endforeach;

            endif;

            $files = array();
            $listTipo = array_keys($dado['fotos_galeria']);

            for ($i = 0; $i < $count; $i++):
                foreach ($listTipo as $t):
                    $files[$i][$t] = $dado['fotos_galeria'][$t][$i];
                endforeach;
            endfor;

            foreach ($files as $arqUpload):

                $upload = new Upload;
                $nomeDocumento = 'usf_foto_' . str_pad($dado['CODIGO'], 4, "0", STR_PAD_LEFT) . '_ano_' . date('Y') . '_' . str_pad($codFoto, 4, "0", STR_PAD_LEFT) . '.jpg';
                $upload->Image($arqUpload, $nomeDocumento, $pasta);

                $dadosFoto = array("CODIGO" => $codFoto,
                    "COD_NOTICIA" => $dado['CODIGO'],
                    "LINK" => $pasta . '/' . $nomeDocumento
                );
                $this->CreateFoto($dadosFoto);
                $codFoto++;
            endforeach;

        endif;

        if ($dado['CAPA']['size'] > 0):
            
            $nomeDocumento = 'usf_foto_' . str_pad($dado['CODIGO'], 4, "0", STR_PAD_LEFT) . '_ano_' . date('Y') . '.jpg';
            
            $localFoto = '../uploads/' . $nomeDocumento;
            if (file_exists($localFoto) && !is_dir($localFoto)):
                unlink($localFoto);
            endif;
            
            $upload = new Upload;
            $upload->Image($dado['CAPA'], $nomeDocumento, $pasta);
        
            $dado['CAPA'] = $pasta . '/' . $nomeDocumento;
            
        else:
            
            $nomeDocumento = 'usf_foto_' . str_pad($dado['CODIGO'], 4, "0", STR_PAD_LEFT) . '_ano_' . date('Y') . '.jpg';
            $dado['CAPA'] = $pasta . '/' . $nomeDocumento;
            
        endif;
        
        
        unset($dado['fotos_galeria']);

        $this->idNoticia = (int) $idNoticia;
        $this->data = $dado;
        $this->Update();
    }

    public function ExeDelete($idNoticia) {

        $this->idNoticia = (int) $idNoticia;

        $readNoticia = new Read;
        $readNoticia->ExeRead(self::Entity, "WHERE CODIGO = :COD", "COD={$this->idNoticia}");
                    
        if ($readNoticia->getResult()):
            foreach ($readNoticia->getResult() as $dadosNot):
                extract($dadosNot);
                $localFoto = '../uploads/' . $CAPA;
                if (file_exists($localFoto) && !is_dir($localFoto)):
                    unlink($localFoto);
                endif;
            endforeach;
        endif;

        $readFoto = new Read;
        $readFoto->ExeRead(self::EntityAux, "WHERE COD_NOTICIA = :CODNOTICIA", "CODNOTICIA={$this->idNoticia}");

        if ($readFoto->getResult()):
            foreach ($readFoto->getResult() as $dadosFoto):
                extract($dadosFoto);
                $localFoto = '../uploads/' . $LINK;
                if (file_exists($localFoto) && !is_dir($localFoto)):
                    unlink($localFoto);
                endif;
            endforeach;
        endif;

        $this->Delete();
        $this->DeleteFoto();
    }

    public function DelFoto($idFoto) {

        $this->idFoto = (int) $idFoto;

        $readFoto = new Read;
        $readFoto->ExeRead(self::EntityAux, "WHERE CODIGO = :CODIGO", "CODIGO={$this->idFoto}");

        foreach ($readFoto->getResult() as $dadosFoto):
            extract($dadosFoto);
            $localFoto = '../uploads/' . $LINK;
            if (file_exists($localFoto) && !is_dir($localFoto)):
                unlink($localFoto);
            endif;
        endforeach;

        $this->DeleteFotoGaleria();
    }

    private function Create() {
        $cadastra = new Create;
        $cadastra->ExeCreateNoticia(self::Entity, $this->data);
//        if ($cadastra->getResult()):
//            $this->result = $cadastra->getResult();
//        endif;
    }

    private function Update() {
        $Update = new Update;
        $Update->ExeUpdateNoticia(self::Entity, $this->data, $this->idNoticia);
        //$Update->ExeUpdate(self::Entity, $this->data, "WHERE CODIGO = :CODIGO", "CODIGO={$this->idNoticia}");
    }

    private function Delete() {
        $Delete = new Delete;
        $Delete->ExeDelete(self::Entity, "WHERE CODIGO = :CODIGO", "CODIGO={$this->idNoticia}");
    }

    private function CreateFoto($dados) {
        $cadastra = new Create;
        $cadastra->ExeCreate(self::EntityAux, $dados);
        if ($cadastra->getResult()):
            $this->result = $cadastra->getResult();
        endif;
    }

    private function DeleteFoto() {
        $delete = new Delete;
        $delete->ExeDelete(self::EntityAux, "WHERE COD_NOTICIA = :CODNOTICIA", "CODNOTICIA={$this->idNoticia}");
    }

    private function DeleteFotoGaleria() {
        $Delete = new Delete;
        $Delete->ExeDelete(self::EntityAux, "WHERE CODIGO = :CODIGO", "CODIGO={$this->idFoto}");
    }

}
