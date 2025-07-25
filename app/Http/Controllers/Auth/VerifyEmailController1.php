<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController1 extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {

        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('welcome', ['locale' => app()->getLocale()], absolute: false).'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {

            event(new Verified($request->user()));

            $user = Auth::user();
            if($user->point == null){
                $user->update(['point' => 500]);
                // petq e notify anel vor 500 point e stacel
            }


        }


        return redirect()->intended(route('welcome', ['locale' => app()->getLocale()], absolute: false).'?verified=1');
    }
}
