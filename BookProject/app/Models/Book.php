<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $primaryKey = 'book_number';
    protected $fillable = [
        'title',
        'title_furigana',
        'cover_pic',
        'publisher',
        'author',
        'year_of_issue',
        'logic_flag'
    ];
}
