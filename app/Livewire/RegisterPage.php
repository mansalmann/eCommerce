<?php

namespace App\Livewire;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Validation\ValidationException;

class RegisterPage extends Component
{
    use LivewireAlert;

    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    protected function rules(){
        $request = new RegisterRequest();
        return $request->rules();
    }

    public function register(){
        try{
            // validasi menggunakan RegisterRequest
            $data = $this->validate($this->rules());
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);
    
            auth()->login($user);
    
            $this->flash('success', 'Halo ' . ucfirst(auth()->user()->name), [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true
            ], session()->get('url.intended'));

        }catch(ValidationException $e) {
            $this->alert('error', collect($e->errors())->flatten()->first(), [
                'position' => 'top',
                'timer' => 3000,
                'toast' => true
            ]);
        }
    }


    public function render()
    {
        return view('livewire.register-page');
    }
}
