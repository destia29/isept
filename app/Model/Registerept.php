<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registerept extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'registerept';

    protected static function boot() {
        parent::boot();
    }

    protected $fillable = [
    'id_eptparticipant', 'id_ept', 'id_availableseat', 'code', 'qr_code', 'status', 'attempt'
    ];

    //RELATION TABLE
    public function eptparticipant() {
        return $this->belongsTo('App\Model\Eptparticipant', 'id_eptparticipant');
    }
    public function ept() {
        return $this->belongsTo('App\Model\Ept', 'id_ept');
    }
    public function score() {
        return $this->hasOne('App\Model\Score', 'id_registerept');
    }
    public function availableseat() {
        return $this->belongsTo('App\Model\Availableseat', 'id_availableseat');
    }
}
