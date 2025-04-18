<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceHistory extends Model
{
    protected $table = 'price_history';
    
    protected $fillable = [
        'product_id',
        'price',
        'promotion_price',
        'effective_from',
        'effective_to'
    ];

    protected $dates = [
        'effective_from',
        'effective_to'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}