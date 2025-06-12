<?php

namespace App\Repositories\User;

use App\Interfaces\User\UserInterface;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository implements UserInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function updatePassword($data){

        $user = $this->getById(Auth::id());

        return $user->update([
                'password' => Hash::make($data->password),
            ]);
    }

}
