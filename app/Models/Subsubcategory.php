<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubsubCategory extends Model {
    protected $fillable = ['name', 'subcategory_id'];

    public function subcategory() {
         return $this->belongsTo(Subcategory::class);
    }
}
