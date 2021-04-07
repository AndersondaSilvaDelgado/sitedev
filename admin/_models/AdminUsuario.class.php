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

    private $data;
    private $idUsuario;
    private $error;
    private $result;

    private $entity;
    
    public function ExeCreateColaborador(array $data) {
        $this->data = $data;
        $this->entity = 'SITE_USUARIO_COLABORADOR';
        $this->CreateColaborador();
    }
    
    public function ExeCreateTerceiro(array $data) {
        $this->data = $data;
        $this->entity = 'SITE_USUARIO_TERCEIRO';
        $this->CreateTerceiro();
    }
    
    public function ExeUpdateColaborador($idUsuario, array $data) {
        $this->idUsuario = (int) $idUsuario;
        $this->data = $data;
        $this->entity = 'SITE_USUARIO_COLABORADOR';
        $this->UpdateColaborador();
    }
    
    public function ExeUpdateTerceiro($idUsuario, array $data) {
        $this->idUsuario = (int) $idUsuario;
        $this->data = $data;
        $this->entity = 'SITE_USUARIO_TERCEIRO';
        $this->UpdateTerceiro();
    }

    public function ExeDeleteColaborador($idUsuario) {
        $this->idUsuario = (int) $idUsuario;
        $this->entity = 'SITE_USUARIO_COLABORADOR';
        $this->DeleteColaborador();
    }
    
    public function ExeDeleteTerceiro($idUsuario) {
        $this->idUsuario = (int) $idUsuario;
        $this->entity = 'SITE_USUARIO_TERCEIRO';
        $this->DeleteTerceiro();
    }

    private function CreateColaborador() {
        $cadastra = new Create;
        $cadastra->ExeCreateColaborador($this->entity, $this->data);
        if ($cadastra->getResult()):
            $this->result = $cadastra->getResult();
        endif;
    }
    
    private function CreateTerceiro() {
        $cadastra = new Create;
        $cadastra->ExeCreateTerceiro($this->entity, $this->data);
        if ($cadastra->getResult()):
            $this->result = $cadastra->getResult();
        endif;
    }
    
    private function UpdateColaborador() {
        $Update = new Update;
        $Update->ExeUpdateColaborador($this->entity, $this->data, $this->idUsuario);
    }
    
    private function UpdateTerceiro() {
        $Update = new Update;
        $Update->ExeUpdateTerceiro($this->entity, $this->data, $this->idUsuario);
    }
    
    private function DeleteColaborador() {
        $Delete = new Delete;
        $Delete->ExeDeleteColaborador($this->entity, $this->idUsuario);
    }
    
    private function DeleteTerceiro() {
        $Delete = new Delete;
        $Delete->ExeDeleteTerceiro($this->entity, $this->idUsuario);
    }
    
}
