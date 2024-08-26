<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'user_email',
        'ic',
        'department',
        'num_day',
        'i_num',
        'img',
        'deadline',
        'status',
    ];
    protected $guard = 'borrower';
}
