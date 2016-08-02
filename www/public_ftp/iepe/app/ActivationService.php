<?php

namespace App;


use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;

class ActivationService
{

    protected $mailer;
    protected $activationRepo;
    protected $resendAfter =  60 * 60 * 8;

    public function __construct(Mailer $mailer, ActivationRepository $activationRepo)
    {
        $this->mailer = $mailer;
        $this->activationRepo = $activationRepo;
    }

    public function sendActivationMail($user)
    {

        if ($user->activated || !$this->shouldSend($user)) {
            return true;
        }

        $token = $this->activationRepo->createActivation($user);

        //$link = route('aspirante.activate', $token);
        $link = action('Auth\AuthController@activateUser', $token);


        try{
            $this->mailer->send('auth.emails.confirmarContraseña', ['link'=>$link] , function (Message $m) use ($user) {
                $m->to($user->email)->subject('Confirmación de correo, registro FARUSAC');
            });
        }
        catch(\Swift_TransportException $e){
            return false;
        }


        return true;
    }

    public function activateUser($token)
    {
        $activation = $this->activationRepo->getActivationByToken($token);

        if ($activation === null) {
            return null;
        }

        $user = Aspirante::find($activation->user_id);

        $user->activated = true;

        $user->save();

        $this->activationRepo->deleteActivation($token);

        return $user;

    }

    private function shouldSend($user)
    {
        $activation = $this->activationRepo->getActivation($user);
        return $activation === null || strtotime($activation->created_at) + $this->resendAfter < time();
    }


}