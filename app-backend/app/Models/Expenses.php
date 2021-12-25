<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;
    protected $table = 'expenses';

    protected $fillable = [
        'name',
        'slug',
        'value',
        'date',
        'receipt_path'
    ];

    public function categories() {
        return $this->belongsTo('App\Categories');
    }
}
