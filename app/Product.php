<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //Indica que cada producto tienen una sola categoria
    public function category(){
      return $this->belongsTo(Category::class);
    }

    public function images(){
      return $this->hasMany(ProductImage::class);
    }

    public function getFeaturedImageUrlAttribute(){
      $featuredImage = $this->images()->where('featured', true)->first();
      if(!$featuredImage){
        $featuredImage = $this->images()->first();
      }
      if($featuredImage){
        return $featuredImage->url;
      }

      // default image
      return 'images/products/default.png';
    }
}
