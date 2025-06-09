<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Enquiry extends Model
{
    use HasApiTokens,HasFactory, SoftDeletes,AuthenticableTrait;
    protected $table = 'enquiry';
    protected $fillable = ['name', 'email', 'phone', 'message','created_at','updated_at'];
     
}
