<?php

namespace App\Services;

use App\Models\social_accounts;
use App\Models\User;

class AuthServices
{
    public function check($email)
    {
        return  User::where('email', $email)->value('email');
        
    }

    
}
