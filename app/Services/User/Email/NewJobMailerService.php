<?php
namespace App\Services\User\Email;


use App\Events\NotificationEvent;
use App\Interfaces\User\UserInterface;
use App\Mail\NewJobsMail;
use Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class NewJobMailerService
{


    public function sendEmail($user,$tasks): void
    {
        App::setLocale($user->lang ?? 'en');

        Mail::to($user->email)->send(new NewJobsMail(

            tasks: $tasks,
            userLang: $user->lang

        ));
    }



}
