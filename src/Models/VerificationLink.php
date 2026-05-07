<?php

namespace App\Models;

use PXP\Data\Model;
use App\Models\User;
use Override;
use Carbon\Carbon;

/**
 * @property string $token
 * @property int $user_id
 */
class VerificationLink extends Model
{
    protected $table = 'verification_link';

    #[Override]
    protected function defaults(): array
    {
        return [
            'token' => uuid(),
        ];
    }

    public function isValid(): bool
    {
        return new Carbon($this->created_at)
            ->diffInMinutes(Carbon::now()) <= 15;
    }

    public function url(): string
    {
        return config('app-url').'/'.route('verify').'?token='.$this->token;
    }
}
