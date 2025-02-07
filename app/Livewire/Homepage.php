<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

class Homepage extends Component
{
    public function render()
    {
        $categories = Category::where('is_active', 1)->get();
        return view('livewire.homepage',[
            'categories' => $categories
        ]);
    }
}
