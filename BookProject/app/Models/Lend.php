<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lend extends Model
{
    use HasFactory;
    protected $primaryKey = 'lend_number';
    protected $fillable = [
        'book_number',
        
    ];

}
