<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
