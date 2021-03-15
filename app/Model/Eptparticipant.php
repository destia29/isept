<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Eptparticipant extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'eptparticipant';

    protected $fillable = [
    'id_user', 'id_major', 'idnumber_eptparticipant', 'gender', 'place_of_birth', 'date_of_birth', 'address', 'handphone_number', 'profile_picture', 'userstatus'
    ];

    protected static function boot() {
        parent::boot();
        static::deleting(function($data) {
            $data->registerept()->delete();
        });
    }

    //RELATION TABLE
    public function user() {
        return $this->belongsTo('App\Model\User', 'id_user');
    }

    public function major() {
        return $this->belongsTo('App\Model\Major', 'id_major');
    }

    public function registerept() {
        return $this->hasMany('App\Model\Registerept', 'id_eptparticipant');
    }

    public function abandoned_participant() {
        return $this->registerept()->whereIn('status', ["Abandoned"]);
    }

    public function attempt_participant() {
        return $this->registerept()->whereNotNull('updated_at');
    }
}
