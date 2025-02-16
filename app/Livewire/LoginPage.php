<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\ValidationException;
use DutchCodingCompany\LivewireRecaptcha\ValidatesRecaptcha;

class LoginPage extends Component
{
    use LivewireAlert;
    public $email;
    public $password;
    public string $gRecaptchaResponse;
    public $request;


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    protected function rules(){
        $request = new LoginRequest();
        return $request->rules();
    }

    public function validateInput(){
        // validasi menggunakan LoginRequest
        $data = $this->validate($this->rules());
        $this->login($data);
    }

    #[ValidatesRecaptcha]    public function login($data){
        try{
            if(auth()->attempt($data)){
                $this->flash('success', 'Halo ' . ucfirst(auth()->user()->name), [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true
                ], session()->get('url.intended'));
            }else{
                throw ValidationException::withMessages([
                    'message' => 'Email or Password is wrong. Try again.'
                ]);
            }

        }catch(ValidationException $e){
             $this->alert('error', collect($e->errors())->flatten()->first(), [
                 'position' => 'top',
                 'timer' => 3000,
                 'toast' => true
             ]);
     
             return;
        }
    }

    public function render()
    {
        return view('livewire.login-page', [
        ]);
    }
}
