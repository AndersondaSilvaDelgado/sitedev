<?php

require ('_app/Library/PHPMailer/class.phpmailer.php');

/**
 * Email.class [ TIPO ]
 * Descricao
 * @copyright (c) year, Anderson da Silva Delgado AULAS
 */
class Email {

    /** @var PHPMailer */
    private $Mail;

    /** Email Data */
    private $Data;

    /** Corpo do E-mail */
    private $Assunto;
    private $Mensagem;

    /** Remetente */
    private $RemetenteNome;
    private $RemetenteEmail;

    /** Destino */
    private $DestinoNome;
    private $DestinoEmail;

    /** $Controle */
    private $Error;
    private $Result;

    function __construct() {
        $this->Mail = new PHPMailer;
        $this->Mail->Host = MAILHOST;
        $this->Mail->Port = MAILPORT;
        $this->Mail->Username = MAILUSER;
        $this->Mail->Password = MAILPASS;
        $this->Mail->CharSet = 'UTF-8';
    }

    public function Enviar(array $Data) {
        $this->Data = $Data;
        $this->Clear();

        if (in_array('', $this->Data)):
            $this->Error = ['Erro ao enviar mensagem: Para enviar esse e-mail. Preencha os campost requisitados!', WS_ALERT];
            $this->Result = false;
        elseif (!Check::Email($this->Data['RemetenteEmail'])):
            $this->Error = ['Erro ao enviar mensagem: Para enviar esse e-mail. O e-mail que você informou não tem um formato válido!', WS_ALERT];
            $this->Result = false;
        else:
            $this->setEmail();
            $this->Config();
        //$this->sendMail();
        endif;
    }

    public function getResult() {
        return $this->Result;
    }

    public function getError() {
        return $this->Error;
    }

    private function Clear() {
        array_map('strip_tags', $this->Data);
        array_map('trim', $this->Data);
    }

    private function setEMail() {
        $this->Assunto = $this->Data['Assunto'];
        $this->Mensagem = $this->Data['Mensagem'];
        $this->RemetenteNome = $this->Data['RemetenteNome'];
        $this->RemetenteEmail = $this->Data['RemetenteEmail'];
        $this->DestinoNome = $this->Data['DestinoNome'];
        $this->DestinoEmail = $this->Data['DestinoEmail'];

        $this->Data = null;
        $this->setMsg();
    }

    private function setMsg() {
        $this->Mensagem = "{$this->Mensagem}<hr><small>Recebida em: " . date('d/m/Y H:i') . "</small>";
    }

    private function Config() {
        $this->Mail->isSMTP();
        $this->Mail->SMTPAuth = true;
        $this->Mail->isHTML();

        $this->Mail->From = MAILUSER;
        $this->Mail->FromName = $this->RemetenteNome;
        $this->Mail->addReplyTo($this->RemetenteEmail, $this->RemetenteNome);

        $this->Mail->Subject = $this->Assunto;
        $this->Mail->Body = $this->Mensagem;
        $this->Mail->addAddress($this->DestinoEmail, $this->DestinoNome);
    }

    private function sendEmail() {
        if ($this->Mail->send()):
            $this->Error = ['Obrigado por entrar em contato: Recebemos sua mensagem e estaremos respondendo em breve!', WS_ACCEPT];
            $this->Result = false;
        else:
            $this->Error = ["Erro ao enviar: Entre em contato com o admin. ( {$this->Mail->ErrorInfo} )", WS_ERROR];
            $this->Result = false;
        endif;
    }

}
