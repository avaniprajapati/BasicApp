<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['categoryId', 'title', 'description'];

    public function category() {
		  return $this->belongsTo('App\Category', 'categoryId');
	  }
}
