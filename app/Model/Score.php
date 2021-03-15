<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Score extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'eptscore';

    protected static function boot() {
        parent::boot();
    }

    protected $fillable = [
    'id_registerept', 'listening_score', 'structure_score', 'reading_score', 'total_score', 'takecourse', 'certif_code'
    ];

    //RELATION TABLE
    public function registerept() {
        return $this->belongsTo('App\Model\Registerept', 'id_registerept');
    }
}
