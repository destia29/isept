<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'epttype';
    protected $fillable = [
    'code', 'type', 'cost'
    ];

    protected static function boot() {
        parent::boot();
        static::deleting(function($data) {
        });
    }

    //RELATION table
  	public function ept() {
  		return $this->hasMany('App\Model\Ept', 'id_epttype');
  	}

    public function getModifCostAttribute($value) {
      return "Rp. " . number_format($this->cost,0,',','.');
    }

}
