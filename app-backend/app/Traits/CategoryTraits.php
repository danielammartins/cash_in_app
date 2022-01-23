<?php

namespace App\Traits;

use App\Models\Category;

trait CategoryTraits {
    /**
     * Returns the ID of a category given it's name
     *
     * @param  
     * @return boolean 
     */
    public function getCategoryID(string $name) {
        $category = Category::where('name', $name)->first();

        if(!$category) {
            return -1;
        }
        else {
            return $category->id;
        }
    }
}

