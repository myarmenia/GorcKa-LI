<?php

namespace App\Repositories\Contact;
use App\Interfaces\Contact\ContactInterface;

use App\Mail\ContactFormMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ContactRepository implements ContactInterface
{
    public function store( $dto): void
    {
        Mail::to("armine.khachatryan1982@gmail.com")->send(new ContactFormMail(
        //  Mail::to("webexprojects@gmail.com")->send(new ContactFormMail(
                name:         $dto->name,
                email:        $dto->email,
                subject:      $dto->subject,
                your_message: $dto->your_message
        ));




    }
}
