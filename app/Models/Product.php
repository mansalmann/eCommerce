<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'images',
        'description',
        'price',
        'stock',
        'is_active',
        'is_featured',
    ];

    protected $casts = [
        'images' => 'array'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
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
