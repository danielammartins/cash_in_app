<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    public $timestamps = false;

    protected $fillable = [
        'name', 
        'main_category',
        'user'
    ];

    public function category() {
        return $this->belongsTo('App\Expenses');
    }
}
