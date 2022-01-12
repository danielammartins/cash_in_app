<?php

namespace App\Traits;

use App\Models\Category;

trait ExpenseTraits {
    /**
     * Checks whether the categories table in the DB has data.
     *
     * @param  
     * @return boolean 
     */
    public function isCategories() {
        if(Category::exists()) {
            return true;
        }
        else {
            return false;
        }
    }
}

