<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'i_num',
        'author',
        'c_img',
        'description',
        'price',
        'id_borrower'
    ];
}
