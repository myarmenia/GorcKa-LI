<?php

namespace App\Services\Auth;

use App\DTO\RegisterDTO;
use App\Interfaces\Auth\RegisterInterface;
use App\Interfaces\BaseInterface;
use App\Mail\VerifyEmail;
use App\Models\Location;
use App\Models\ReferralCode;
use Illuminate\Support\Facades\Auth;
use Mail;
use Request;
class RegisterService
{
    public function __construct(protected RegisterInterface $registerRepository) {}



    public function store($dto): mixed
    {
        $referrerCode = ReferralCode::where('code', $dto->referral_code)->first();
        $dto->referred_by_code_id = $referrerCode?->id;

        $user = $this->registerRepository->store($dto->toArray());

        $user->assignRole('user');

        Mail::to($user->email)->send(new VerifyEmail($user));

        Auth::login($user);

        return $user;
    }


}
