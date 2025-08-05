<?php

namespace App\Repositories\Specialist;

use App\Interfaces\Specialist\TopSpecialistInterface;
use App\Models\User;

class TopSpecialistRepository  implements TopSpecialistInterface
{

    public function getTopSpecialistRating()
    {
       $topSpecialistRating = User::select('users.id', 'users.name','users.description', 'users.email','users.avatar') // только нужные поля
                            ->join('comments', 'users.id', '=', 'comments.recipient_id')
                            ->where('comments.status', 1)
                            ->selectRaw('AVG(comments.mark) as average_mark')
                            ->groupBy('users.id', 'users.name','users.description', 'users.email','users.avatar') // добавь все select поля
                            ->orderByDesc('average_mark')
                            ->take(6)
                            ->get();

        return $topSpecialistRating;
    }
}
