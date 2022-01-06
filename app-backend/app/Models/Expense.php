<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    
    protected $table = 'expenses';
    public $timestamps = false;

    protected $fillable = [
        'name', 
        'value',
        'date',
        'receipt_path',
        'description',
        'category_id'
    ];
}
