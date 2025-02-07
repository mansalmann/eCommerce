<?php

namespace App\Livewire;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class LoginPage extends Component
{
    use LivewireAlert;
    public $email;
    public $password;
    public $request;


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    protected function rules(){
        $request = new LoginRequest();
        return $request->rules();
    }

    public function login(Request $request){
        try{
            $data = $this->validate($this->rules());
            // validasi menggunakan LoginRequest
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
