<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   //Indica que una categoria tiene muchos productos
   public function products(){
     return $this->hasMany(Product::class);
   }
}
