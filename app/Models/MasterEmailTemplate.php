<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterEmailTemplate extends Model
{
    use HasFactory;

    protected $table = 'master_email_template';

    protected $fillable = [
        'title','description','status','delete'
    ];
}
