<?php

namespace App\Services\Auth;

use App\DTO\RegisterDTO;
use App\Interfaces\Auth\RegisterInterface;
use App\Interfaces\BaseInterface;
use App\Mail\VerifyEmail;
use App\Models\Location;
use Illuminate\Support\Facades\Auth;
use Mail;
use Request;
class RegisterService
{
    public function __construct(protected BaseInterface $registerRepository) {}


    
    public function store($dto)
    {

        $user = $this->registerRepository->store($dto->toArray());

        $user->assignRole('user');

        Mail::to($user->email)->send(new VerifyEmail($user));

        Auth::login($user);

        return $user;
    }


}
