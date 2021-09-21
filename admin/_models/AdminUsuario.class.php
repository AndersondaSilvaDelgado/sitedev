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
class AdminUsuario {

    //put your code here

    private $data;
    private $idUsuario;
    private $error;
    private $result;

    const Entity = 'SITE_USUARIO_NV';

    public function ExeCreate(array $data) {

        $this->data = $data;
        $this->Create();
    }

    public function ExeUpdate($idUsuario, array $data) {

        $this->idUsuario = (int) $idUsuario;
        $this->data = $data;
        $this->Update();
    }

    public function ExeDelete($idUsuario) {
        $this->idUsuario = (int) $idUsuario;
        $this->Delete();
    }

    private function Create() {
        $cadastra = new Create;
        $cadastra->ExeCreate(self::Entity, $this->data);
        if ($cadastra->getResult()):
            $this->result = $cadastra->getResult();
        endif;
    }

    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->data, "WHERE CODIGO = :CODIGO", "CODIGO={$this->idUsuario}");
    }

    private function Delete() {
        $Delete = new Delete;
        $Delete->ExeDelete(self::Entity, "WHERE CODIGO = :CODIGO", "CODIGO={$this->idUsuario}");
    }

}
