<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'eptroom';

    protected static function boot() {
        parent::boot();
    }

    protected $fillable = [
    'room_name', 'capacity'
    ];

    //RELATION table
    public function availableseat() {
      return $this->hasMany('App\Model\Availableseat', 'id_eptroom');
    }

}
