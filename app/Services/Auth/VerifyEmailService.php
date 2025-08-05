<?php

namespace App\Services\Auth;

use App\Models\ReferralCode;
use App\Services\Admin\Referral\ReferralCodeService;
use App\Services\User\Notify\NotificationCreator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\DB;

class VerifyEmailService
{
    public function __construct(
            protected ReferralCodeService $referralCodeService,
            protected NotificationCreator $notificationCreator
        )
    {
    }

    public function verifyEmail($user): mixed
    {

        if ($user->markEmailAsVerified()) {
            DB::beginTransaction();

            try{

                event(new Verified($user));


                if ($user->point == null) {
                    if ($user->point === null) {
                        $user->point = 0;
                        $user->save();
                    }

                    if($user->referred_by_code_id != null){

                        $referrer = $user->referrer;

                        $user->increment('point', 550);

                        if($referrer){
                            $referrer->increment('point', 50);
                            $this->notificationCreator->create($referrer, 'referal_point');
                        }

                    }
                    else{

                        $user->increment('point', 500);
                    }

                }

                $this->referralCodeService->createReferralCode($user->id);

                DB::commit();

                return $user;

            } catch (\Exception $e) {
                DB::rollBack();
                return back()->withErrors(['registration_error' => 'Ошибка при регистрации. Попробуйте позже.']);
            }

        }

        return false;
    }


}
