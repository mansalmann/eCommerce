<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PasswordResetTokens;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public $result;

    public function showLoginPage(){
        return response()->view('parts.auth.login-page', []);
    }
    public function showRegisterPage(){
        return response()->view('parts.auth.register-page', []);
    }
    public function showForgotPasswordPage(){
        return response()->view('parts.auth.forgot-password-page', []);
    }
    public function showResetPasswordPage(Request $request){
        if (!$request->hasValidSignatureWhileIgnoring(['token'])) {
            return redirect()->route('home');
        }

        // cari data token di tabel
        $result = null;
        $password_resets_data = PasswordResetTokens::query()->get(['id', 'user_id','token']);
        
        // pengecekan token
        foreach($password_resets_data as $data)  {
            $results = Hash::check( $request->token, $data->token);
            if($results){
                $result = $data;                
                break;
            }            
        }
        
        if(isset($request->token) && $result){
            $user = User::where("id", $result->user_id)->first();            
            return response()->view("parts.auth.reset-password-page", ["user" => $user]);
        }else{
            return redirect()->route('home');
        }
    }
}
