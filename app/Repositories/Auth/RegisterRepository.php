<?php

namespace App\Repositories\Auth;

use App\Interfaces\Auth\RegisterInterface;
use App\Models\User;
use App\Repositories\BaseRepository;

class RegisterRepository extends BaseRepository implements RegisterInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
