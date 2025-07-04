<?php

namespace App\Interfaces\User;

use App\Interfaces\BaseInterface;

interface UserInterface extends BaseInterface
{

    public function updatePassword($data);
    public function userComment();

}
