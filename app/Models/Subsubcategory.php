<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubsubCategory extends Model {
    protected $fillable = ['name', 'subcategory_id'];

    public function subcategory() {
         return $this->belongsTo(Subcategory::class);
    }

    public function products()
{
    return $this->hasMany(\App\Models\Product::class, 'subsub_category_id');
}
}
