<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'government',
        'address',
        'note',
        'subtotal',
        'shipping_cost',
        'total',
        'status'
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
                    ->withPivot(['quantity', 'price_at_time', 'promotion_price_at_time', 'subtotal'])
                    ->withTimestamps();
    }
}
