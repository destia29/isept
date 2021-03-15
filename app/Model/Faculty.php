<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faculty extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'faculty';

    protected static function boot() {
        parent::boot();
        static::deleting(function($data) {
            $data->major()->delete();
        });
    }

      //RELATION table
    	public function major() {
    		return $this->hasMany('App\Model\Major', 'id_faculty');
    	}
}
