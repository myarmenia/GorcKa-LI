<?php

namespace App\Repositories\Auth;

use App\Interfaces\Auth\RegisterInterface;
use App\Interfaces\BaseInterface;
use App\Models\ReferralCode;
use App\Models\User;
use App\Repositories\BaseRepository;

class RegisterRepository extends BaseRepository implements RegisterInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    // public function store($dto)
    // {

    //     $user = $this->store($dto->toArray());

    //     $user->assignRole('user');

    //     if ($referral) {
    //         if ($referral->user_id) {
    //             // Пользовательский код – 50/50
    //             $user->increment('points', 50);
    //             $referral->user->increment('points', 50);

    //         } else {
    //             // Код из соцсетей/админа
    //             $user->increment('points', 100);
    //         }
    //     }

    //     return $user;

    // }
}
