<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPage extends Model
{
    use HasFactory;

    protected $table = 'master_pages';

    protected $fillable = [
        'title','description','meta_title','meta_keyword','meta_description','status','delete'
    ];
}
