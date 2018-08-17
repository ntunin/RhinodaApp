<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
      return $this->belongsToMany(Role::class);
    }

    public function skypeAccounts()
    {
      return $this->belongsToMany(SkypeAccount::class);
    }

    public function hasRole($role) {
      $roles = $this->roles;
      foreach ($roles as $userRole) {
        if ($role->id == $userRole->id) {
          return true;
        }
      }
      return false;
    }
}
