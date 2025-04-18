<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'unite',
        'description',
        'reference',
        'quantity',
        'status',
        'promotion',
        'promotion_value',
        'subsub_category_id',
        'price',
    ];

    public function subsubCategory()
    {
        return $this->belongsTo(\App\Models\SubsubCategory::class, 'subsub_category_id');
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'image_product')->withTimestamps();
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)
                    ->withPivot(['quantity', 'price_at_time', 'promotion_price_at_time', 'subtotal'])
                    ->withTimestamps();
    }

    public function priceHistory()
    {
        return $this->hasMany(PriceHistory::class);
    }

    public function getCurrentPrice()
    {
        return $this->priceHistory()
            ->whereNull('effective_to')
            ->first();
    }

    public function scopePromoted($query)
    {
        return $query->where('promotion', true);
    }
}


