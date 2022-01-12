<?php
namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait UserTraits {

    public function getUserID() {
        $id = Auth::id();
        return $id;
    }
}
