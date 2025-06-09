<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterCompanySetting extends Model
{
    use HasFactory;

    protected $table = 'setting_company';

    protected $fillable = [
        'company_name','company_logo','address','email','phone','website','currency'
    ];
}
