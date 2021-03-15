<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
      protected $table = 'lcservice';

      protected $fillable = [
      'name', 'quantity', 'cost'
      ];

      public function getModifCostAttribute($value) {
        return "Rp. " . number_format($this->cost,0,',','.');
    }
}
