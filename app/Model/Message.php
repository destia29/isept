<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
      protected $table = 'lcmessage';

        protected $fillable = [
        'name', 'email', 'subject', 'message'
        ];
}
