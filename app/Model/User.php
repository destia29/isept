<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // protected $dates = ['deleted_at'];
      protected $table = 'users';

      protected $fillable = [
      'id_role', 'username', 'name', 'email', 'password'
      ];

      protected $hidden = [
          'password', 'remember_token',
      ];

      protected static function boot() {
          parent::boot();
          static::deleting(function($data) {
              // $data->adminuser()->delete();
              // $data->eptparticipant()->delete();
          });
      }

      //RELATION table
    	public function role() {
    		return $this->belongsTo('App\Model\Role', 'id_role');
    	}
        public function adminuser() {
    		return $this->hasOne('App\Model\Adminuser', 'id_user');
    	}
        public function eptparticipant() {
    		return $this->hasOne('App\Model\Eptparticipant', 'id_user');
    	}

}
