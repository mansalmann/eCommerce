<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\PasswordResetTokens;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ResetPasswordRequest;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ResetPasswordPage extends Component
{
    use LivewireAlert;
    public $user;
    public $password;
    public $password_confirmation;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    protected function rules(){
        $request = new ResetPasswordRequest();
        return $request->rules();
    }

    public function resetPassword(){
        $data = $this->validate($this->rules());

        $user = User::find($this->user->id);

        if($user){
            $user->password = Hash::make($data['password']);
            $user->save();

            PasswordResetTokens::where('user_id', $user->id)->delete();
    
            $this->alert('success', 'Your password has been changed.', [
                'position' => 'top',
                'timer' => 3000,
                'toast' => true
            ]);
    
            return redirect()->route('login');
        }
        
        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.reset-password-page', [
        ]);
    }
}
