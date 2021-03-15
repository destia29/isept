<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'role';

    protected static function boot() {
        parent::boot();
        static::deleting(function($data) {
            $data->users()->delete();
        });
    }

    //RELATION table
  	public function users() {
  		return $this->hasMany('App\Model\User', 'id_role');
  	}
}
