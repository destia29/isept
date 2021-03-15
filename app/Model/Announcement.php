<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
      protected $table = 'lcannouncement';

        protected $fillable = [
        'title', 'thumbnail', 'description', 'release_date', 'tag', 'id_user'
        ];

        public function user() {
    		return $this->belongsTo('App\Model\User', 'id_user');
    	}
}
