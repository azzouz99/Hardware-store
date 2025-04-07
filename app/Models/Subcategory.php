<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model {
    protected $fillable = ['name', 'category_id'];

    public function category() {
         return $this->belongsTo(Category::class);
    }

    public function subsubcategories() {
         return $this->hasMany(SubsubCategory::class);
    }

    public function products()
{
    return $this->hasManyThrough(
        \App\Models\Product::class,         // Final model
        \App\Models\SubsubCategory::class,    // Intermediate model
        'subcategory_id',                    // Foreign key on SubsubCategory that references Subcategory
        'subsub_category_id',                // Foreign key on Product that references SubsubCategory
        'id',                                // Local key on Subcategory
        'id'                                 // Local key on SubsubCategory
    );
}

}