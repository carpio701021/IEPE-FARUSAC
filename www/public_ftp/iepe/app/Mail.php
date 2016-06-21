<?php

namespace App;

use PHPMailer;
use Psy\Util\Json;

class Mail
{
    private $mail;

    function __construct()
    {
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();

        //SMTDebug
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $this->mail->SMTPDebug = 0;
        //$this->mail->Debugoutput = 'html';

        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->Port = 587; //443
        //encriptamiento tls
        $this->mail->SMTPSecure = 'tls';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = env('MAIL_USERNAME');
        $this->mail->Password = env('MAIL_PASSWORD');
    }

    public function send($emailArray, $subject, $msg,$pdf,$fileName){

        $this->mail->setFrom($this->mail->Username, 'FARUSAC');
        $this->mail->Subject = $subject;
        $this->mail->msgHTML('<p>'.$msg.'</p>');
        $this->mail->addAddress($this->mail->Username);
        $this->mail->CharSet = 'UTF-8';
        foreach($emailArray as $email => $name) {
            $this->mail->AddBCC($email, $name);
        }
        if($pdf){
            $this->mail->addStringAttachment($pdf,$fileName,'base64','application/pdf');
        }
        return $this->mail->send();
    }
    
    public function sendExcel($mail,$name, $subject, $msg,$path,$filename){
        $this->mail->setFrom($this->mail->Username, 'FARUSAC');
        $this->mail->addAddress($mail, $name);
        $this->mail->Subject = $subject;
        $this->mail->msgHTML('<p>'.$msg.'</p>');
        $this->mail->AddAttachment($path,$filename);
        $this->mail->CharSet = 'UTF-8';
        return $this->mail->send();
    }

    public function simpleSend($email,$name, $subject, $msg){

        $this->mail->setFrom($this->mail->Username, 'FARUSAC');
        $this->mail->addAddress($email, $name);
        $this->mail->Subject = $subject;
        $this->mail->msgHTML('<p>'.$msg.'</p>');
        $this->mail->CharSet = 'UTF-8';
        //return "hola";
        return $this->mail->send();
    }

    public function multiSend($asignaciones, $subject, $msg){



        $this->mail->setFrom($this->mail->Username, 'FARUSAC');
        $this->mail->Subject = $subject;
        $this->mail->msgHTML('<p>'.$msg.'</p>');
        $this->mail->CharSet = 'UTF-8';
        $msg=[];
        foreach ($asignaciones as $asig) { //This iterator syntax only works in PHP 5.4+
            $aspirante = Aspirante::find($asig->aspirante_id);
            $this->mail->addAddress($aspirante->email, $aspirante->nombre);
            if (!$this->mail->send()) {
                $msg[]= "Mailer Error (" . str_replace("@", "&#64;", $aspirante->email). ') ' . $this->mail->ErrorInfo . '<br />';
                //break; //Abandon sending
            } else {
                $msg[]="Message sent to :" . $aspirante->NOV . ' (' . str_replace("@", "&#64;", $aspirante->email) . ')<br />';
                //Mark it as sent in the DB
            }
            // Clear all addresses and attachments for next loop
            $this->mail->clearAddresses();
        }
        return $msg;
    }

    public function getError(){
        return $this->mail->ErrorInfo;
    }
}