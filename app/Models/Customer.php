<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;


class Customer extends Model implements Authenticatable
{
    use HasApiTokens,HasFactory, SoftDeletes,AuthenticableTrait;
    protected $table = 'customers';

    protected $fillable = [
        'first_name',
        'phone',
        'email',
        'password',
    ];
    
}
?>