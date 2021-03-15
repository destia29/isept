<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Major extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'major';

    protected static function boot() {
        parent::boot();
        static::deleting(function($data) {
            $data->users()->delete();
        });
    }

      //RELATION table
    	public function faculty() {
    		return $this->belongsTo('App\Model\Faculty', 'id_faculty');
    	}
      	public function eptparticipant() {
      		return $this->hasMany('App\Model\Eptparticipant', 'id_major');
      	}
}
