<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   public function discussions(){
       return $this->hasMany('App\Discussion');
   }
}
