<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class color extends Model
{
    use HasFactory;

    protected $table = 'colors';
    
    protected $fillable = [
        'name',
        'hex',
        'created_at',
        'updated_at',
    ];
}
