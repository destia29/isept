<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ept extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'ept';

    protected $fillable = [
    'id_epttype', 'id_eptcode', 'ept_name', 'ept_date', 'ept_time', 'ept_room', 'ept_quota', 'registration_date', 'code', 'qr_code'
    ];

    protected static function boot() {
        parent::boot();
        static::deleting(function($data) {
        });
    }

    //RELATION TABLE
    public function type() {
        return $this->belongsTo('App\Model\Type', 'id_epttype');
    }

    public function code_ept() {
        return $this->belongsTo('App\Model\Code', 'id_eptcode');
    }

    public function registerept() {
        return $this->hasMany('App\Model\Registerept', 'id_ept');
    }

    public function registerept_registered() {
        return $this->registerept()->whereIn('status', ["Verified", "Done"]);
    }

    public function registerept_participant() {
        return $this->registerept()->whereNotIn('status', ["Abandoned"]);
    }

  	public function availableseat() {
  		return $this->hasMany('App\Model\Availableseat', 'id_ept');
  	}
}
