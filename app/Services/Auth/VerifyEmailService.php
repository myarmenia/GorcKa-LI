<?php

namespace App\Services\Auth;

use App\Models\ReferralCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\DB;

class VerifyEmailService
{

    public function verifyEmail($user): mixed
    {

        if ($user->markEmailAsVerified()) {
            DB::beginTransaction();

            try{

                event(new Verified($user));


                if ($user->point == null) {
                    if($user->referred_by_code_id){

                        $user->increment('points', 550);
                        $user->referrer?->increment('points', 50);

                    }
                    else{

                        // $user->increment('points', 500);
                        $user->update(['point' => 500]);

                    }

                }

                $this->createReferalCode($user->id);

                DB::commit();

                return $user;

            } catch (\Exception $e) {
                DB::rollBack();
                return back()->withErrors(['registration_error' => 'Ошибка при регистрации. Попробуйте позже.']);
            }

        }

        return false;
    }


    protected function createReferalCode($userId)
    {

        $uniqueCode = $this->generateUniqueReferralCode();

        ReferralCode::create([
            'code' => $uniqueCode,
            'user_id' => $userId,
            'source' => 'user-generated',
        ]);

    }



    protected function generateUniqueReferralCode(): string
    {
        do {
            $code = strtoupper(Str::random(10));
        } while (ReferralCode::where('code', $code)->exists());

        return $code;
    }

}
