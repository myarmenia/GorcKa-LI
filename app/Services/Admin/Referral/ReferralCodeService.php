<?php
namespace App\Services\Admin\Referral;

use App\Mail\ReferralCodesGenerated;
use App\Models\ReferralCode;
use Mail;
use Str;

class ReferralCodeService
{

    public function generateReferralCodesByAdmin(array $data): void
    {
        $sources = ['instagram', 'facebook', 'telegram'];
        $count = (int) ($data['count'] ?? 1);
        $codes = [];


        foreach ($sources as $source) {
            for ($i = 0; $i < $count; $i++) {
                $referral = $this->createReferralCode(null, $source);
                $codes[] = [
                    'source' => $source,
                    'code' => $referral->code ?? '—',
                ];
            }
        }

        $email = $data['email'] ?? config('mail.admin_email');

        Mail::to($email)->send(new ReferralCodesGenerated($codes));
    }

    public function createReferralCode(?int $userId = null, ?string $source = null): ReferralCode
    {

        $uniqueCode = $this->generateUniqueReferralCode();

        $referral_code = ReferralCode::create([
            'code' => $uniqueCode,
            'user_id' => $userId,
            'source' => $source ?? 'user-generated',
        ]);

        return $referral_code;

    }


    protected function generateUniqueReferralCode(): string
    {
        do {
            $code = strtoupper(Str::random(10));
        } while (ReferralCode::where('code', $code)->exists());

        return $code;
    }


}
