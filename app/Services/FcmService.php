<?php
namespace App\Services;

use App\Interfaces\User\UserInterface;
use Auth;


class FcmService
{
    public function __construct(protected UserInterface $userRepository) {
    }

    public function saveToken($data)
    {
        $user = Auth::user();
      
        return $this->userRepository->update($user->id, ['fcm_token' => $data->token]);

    }
}
