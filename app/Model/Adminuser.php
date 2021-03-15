<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Adminuser extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
      protected $table = 'adminuser';

      protected $fillable = [
      'id_user', 'position', 'nip_user', 'handphone_number', 'profile_picture'
      ];

      protected static function boot() {
          parent::boot();
      }

      //RELATION TABLE
      public function user() {
          return $this->belongsTo('App\Model\User', 'id_user');
      }
}
