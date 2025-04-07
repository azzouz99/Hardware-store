<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['image_path'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'image_product')
                    ->withPivot('sort_order')
                    ->withTimestamps();
    }
}

