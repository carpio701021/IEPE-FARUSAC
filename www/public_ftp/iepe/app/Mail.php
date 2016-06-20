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
        //$this->mail->addAddress($mail, $name);
        foreach($emailArray as $email => $name)
        {
            //return Json::encode($email);
            $this->mail->AddCC($email, $name);

        }
        $this->mail->Subject = $subject;
        $this->mail->msgHTML('<p>'.$msg.'</p>');
        if($pdf){
            $this->mail->addStringAttachment($pdf,$fileName,'base64','application/pdf');
        }
        $this->mail->CharSet = 'UTF-8';
        //return "hola";
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

    public function getError(){
        return $this->mail->ErrorInfo;
    }
}