<?php

namespace App\Services;

use App\Models\social_accounts;
use App\Models\User;

class AuthServices
{
    public function check($email)
    {
        $check = User::where('email', $email)->value('email');
        return $check;
    }
}
