<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\PasswordResetTokens;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\ForgotPasswordRequest;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ForgotPasswordPage extends Component
{
    use LivewireAlert;
    public $email;
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    protected function rules(){
        $request = new ForgotPasswordRequest();
        return $request->rules();
    }

    public function sendRequestToEmail(){
        $data = $this->validate($this->rules());

        $user = User::query()->where('email', $data['email'])->first();

        if($user){
            // membuat token untuk atur ulang password
            $token = Str::random(24);
            $limitedTimeUrl = URL::temporarySignedRoute('reset-password', now()->addMinutes(15)) . "&token=" . $token; // url dengan limitasi waktu

            // membuat isian untuk template email atur ulang password    
            $dataFormat["url"] = $limitedTimeUrl;
            $dataFormat["email"] = $data["email"];
            $dataFormat["title"] = "Password Reset";
            $dataFormat["body"] = "Click the link below to reset your password";

            // kirim email
            Mail::send("parts.auth.reset-password-mail", ["data" => $dataFormat], function($message) use($dataFormat) {
                $message->to($dataFormat["email"])->subject($dataFormat["title"]);
            });

            // buat data tabel password_reset_tokens baru
            $passwordReset = new PasswordResetTokens();
            if(PasswordResetTokens::query()->where('email', $data['email'])->exists()){
                $query = PasswordResetTokens::query()->where('email', $data['email'])->get();
                foreach($query as $data){
                    $data->delete();
                }
            }

            $passwordReset->email = $data["email"];
            $passwordReset->token = Hash::make($token);
            $passwordReset->user_id = $user->id;
            $passwordReset->created_at = Carbon::now()->format("Y-m-d H:i:s");
            $passwordReset->save();

            $this->alertTemplate('success','Please check your email to reset your password');
            $this->email = '';
        }else{
            $this->alertTemplate('info','Please kindly check your email typing.');
        }
    }

    public function alertTemplate($type, $message){
        $this->alert($type, $message, [
            'position' => 'top',
            'timer' => 3000,
            'toast' => true
        ]);
    }

    public function render()
    {
        return view('livewire.forgot-password-page');
    }
}
