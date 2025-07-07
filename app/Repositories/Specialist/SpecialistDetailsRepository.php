<?php

namespace App\Repositories\Specialist;
use App\Interfaces\Specialist\SpecialistDetailsInterface;
use App\Models\User;

class SpecialistDetailsRepository implements SpecialistDetailsInterface
{
    public function getById($specialist): User
    {

      return $specialist->load('files','social_medias','executor_sub_categories','location.translation','receivedComments.author', 'receivedComments.task');

    }
}
