<?php
namespace App\Services\User;


use App\Interfaces\User\UserInterface;

class UserPointUpdaterService
{
    public function __construct(protected UserInterface $userRepository)
    {
    }

    public function decrement($user, int $point = 1): void
    {
        $this->userRepository->update($user->id, [
            'point' => $user->point - $point
        ]);
    }
}
