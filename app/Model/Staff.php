<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
      protected $table = 'lcstaff';

        protected $fillable = [
        'name', 'position', 'facebook', 'twitter', 'googleplus', 'instagram', 'picture'
        ];

}
