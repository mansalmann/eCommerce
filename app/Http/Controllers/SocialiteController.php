<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Socialite as ModelSocialite;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    // controller untuk menangani login dan register dengan media sosial menggunakan Sosialite
    public function redirect($provider){
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function callback($provider){
        $socialUser = Socialite::driver($provider)->stateless()->user();
        $authUser = $this->store($socialUser, $provider);
        Auth::login($authUser);
        return redirect()->intended();
    }

    public function store($socialUser, $provider){
        $socialAccount = ModelSocialite::where('provider_id', $socialUser->getId())->where('provider_name', $provider)->first();

        if(!$socialAccount){
            $user = User::where('email', $socialUser->getEmail())->first();
            if(!$user){
                $user = User::create([
                    'name' => $socialUser->getName() ? $socialUser->getName() : $socialUser->getNicname(),
                    'email' => $socialUser->getEmail(),
                    'password' => Str::random(10)
                ]);
            }

                // membuat data socialite berdasarkan provider_id dan provider_name pada user yang baru saja dibuat
                $user->socialites()->create([
                    'provider_id' => $socialUser->getId(),
                    'provider_name' => $provider,
                    'provider_token' => $socialUser->token,
                    'provider_refresh_token' => $socialUser->refreshToken,
                ]);
            return $user;
        }

        return $socialAccount->user;
    }
}
