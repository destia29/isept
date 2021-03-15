<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Availableseat extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'availableseat';

    protected static function boot() {
        parent::boot();
    }

    protected $fillable = [
    'id_eptroom', 'id_ept', 'available', 'isfull'
    ];

    //RELATION table
    public function registerept() {
      return $this->hasMany('App\Model\Registerept', 'id_availableseat');
    }
    public function room() {
        return $this->belongsTo('App\Model\Room', 'id_eptroom');
    }
    public function ept() {
        return $this->belongsTo('App\Model\Ept', 'id_ept');
    }
}
