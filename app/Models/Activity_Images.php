<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity_Images extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'acvity_images';
}
