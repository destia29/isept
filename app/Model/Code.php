<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Code extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'eptcode';
    protected $fillable = [
      'code'
    ];

    protected static function boot() {
        parent::boot();
        static::deleting(function($data) {
        });
    }

    //RELATION table
  	public function ept() {
  		return $this->hasMany('App\Model\Ept', 'id_eptcode');
  	}
}
