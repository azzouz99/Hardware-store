<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'unite',
        
        'reference',
        'quantity',
        'status',
        'promotion',
        'promotion_value',
        'subsub_category_id',  // Ensure this field exists in your migration
        'price',
        // If you store images in a JSON field, include 'images'
    ];

    public function subsubCategory()
    {
        return $this->belongsTo(SubsubCategory::class);
    }
    public function images()
    {
        return $this->belongsToMany(Image::class, 'image_product')->withTimestamps();
    }
}


