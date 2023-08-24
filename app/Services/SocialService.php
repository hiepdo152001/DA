<?php

namespace App\Services;

use App\Models\social_accounts;

class SocialService
{
   public function create($googleUser,$user){
    social_accounts::create(
        [
            'social_id' => $googleUser->id,
            'social_name' => $googleUser->name,
            'social_provider' => 'google',
            'user_id' => $user->id
        ],
    );
   }
}