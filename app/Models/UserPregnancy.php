<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPregnancy extends Model
{
    use HasFactory;
    protected $table = 'user_pregnancy';
    protected $fillable = [
        'name',
    ];
}
