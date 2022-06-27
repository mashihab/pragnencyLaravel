<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregnancypreparation extends Model
{
    use HasFactory;
    protected $table = 'pregnancy_preparation';
    protected $fillable = [
        'name',
    ];
}
