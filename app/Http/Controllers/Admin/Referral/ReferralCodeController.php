<?php

namespace App\Http\Controllers\Admin\Referral;

use App\Http\Controllers\Controller;
use App\Services\Admin\Referral\ReferralCodeService;
use Illuminate\Http\Request;

class ReferralCodeController extends Controller
{
    public function __construct(protected ReferralCodeService $referralCodeService)
    {
    }
    public function __invoke(Request $request)
    {

        try {
            $this->referralCodeService->generateReferralCodesByAdmin($request->all());

            return response('Реферальные коды успешно сгенерированы.');
        } catch (\Throwable $e) {

            return response( 'Произошла ошибка при генерации реферальных кодов.');
        }

    }
}
