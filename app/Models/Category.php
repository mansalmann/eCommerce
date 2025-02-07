<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'name', 
        'slug', 
        'image', 
        'is_active'
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }

    public static function generateUniqueSlug(string $name):string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;
        while(self::where('slug', $slug)->exists())
        {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
