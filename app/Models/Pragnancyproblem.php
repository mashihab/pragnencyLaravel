<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pragnancyproblem extends Model
{
    use HasFactory;
    protected $table = 'pragnancy_problem';
    protected $fillable = [
        'name',
    ];
}
