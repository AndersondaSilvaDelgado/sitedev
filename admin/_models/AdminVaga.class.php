<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminVaga
 *
 * @author anderson
 */
class AdminVaga {
    //put your code here
    
    //put your code here

    private $data;
    private $idVaga;
    private $error;
    private $result;

    const Entity = 'SITE_VAGAS';

    public function ExeCreate(array $data) {
        $this->data = $data;
        $this->Create();
    }

    public function ExeUpdate($idVaga, array $data) {
        $this->idVaga = (int) $idVaga;
        $this->data = $data;
        $this->Update();
    }

    public function ExeDelete($idVaga) {
        $this->idVaga = (int) $idVaga;
        $this->Delete();

    }

    private function Create() {
        $cadastra = new Create;
        $cadastra->ExeCreateVaga(self::Entity, $this->data);
//        if ($cadastra->getResult()):
//            $this->result = $cadastra->getResult();
//        endif;
    }

    private function Update() {
        $Update = new Update;
        $Update->ExeUpdateVaga(self::Entity, $this->data, $this->idVaga);
//        $Update->ExeUpdate(self::Entity, $this->data, "WHERE CODIGO = :CODIGO", "CODIGO={$this->idVaga}");
    }

    private function Delete() {
        $Delete = new Delete;
        $Delete->ExeDelete(self::Entity, "WHERE CODIGO = :CODIGO", "CODIGO={$this->idVaga}");
    }
    
}
