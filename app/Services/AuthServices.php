<?php

namespace App\Services;

use App\Models\social_accounts;

class AuthServices
{
    public function check($social_id)
    {
        $check = social_accounts::where('social_id', $social_id);
        return $check;
    }
}
