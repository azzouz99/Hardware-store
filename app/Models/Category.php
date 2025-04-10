<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    protected $fillable = ['name', 'icon'];

    public function getProductsByCategory()
{
    $products = collect();

    // Loop through each subcategory in the category
    foreach ($this->subcategories as $subcategory) {
        // Loop through each subsub-category of this subcategory.
        // Ensure that the relationship on Subcategory is named 'subsubcategories' (adjust if your naming differs).
        foreach ($subcategory->subsubcategories as $subsub) {
            // Merge the products from this subsub-category into the collection.
            // Here, we assume that each SubsubCategory has a 'products' relationship.
            $products = $products->merge($subsub->products);
        }
    }

    return $products;
}


    public function subcategories() {
         return $this->hasMany(Subcategory::class);
    }
}
