<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class URL extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'Real_Path',
        'New_Path',
        'Password',
        'user_id'
    ];
}
