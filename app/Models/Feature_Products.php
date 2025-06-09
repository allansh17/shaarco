<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feature_Products extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'feature_products';
}
