<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Authenticatable
{
    use HasApiTokens,Notifiable,HasRoles;
    use softDeletes;
    protected $table = 'employee_general_info';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   protected $fillable = [
        'first_name', 'last_name','email', 'password', 'email_verified_at','remember_token', 'phone','address','pin','dob','profile_image','is_superadmin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function get_roles(){
        $roles = [];
        foreach ($this->getRoleNames() as $key => $role) {
            $roles[$key] = $role;
        }

        return $roles;
    }
}
