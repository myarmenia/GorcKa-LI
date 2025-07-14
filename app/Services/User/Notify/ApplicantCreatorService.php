<?php
namespace App\Services\User\Notify;

use App\DTO\User\ApplicantDTO;
use App\Interfaces\Applicant\ApplicantInterface;
class ApplicantCreatorService
{
    public function __construct(protected ApplicantInterface $applicantRepository) {}

    public function create($task, $user): void
    {
        $applicant = new ApplicantDTO(
            task_id: $task->id,
            point: 19,
            user_id: $user->id
        );

        $this->applicantRepository->store($applicant->toArray());
    }
}
