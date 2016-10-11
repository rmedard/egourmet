<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['dish_resto_id', 'email', 'value', 'comment'];

    public function dishresto(){
        return $this->belongsTo(DishResto::class);
    }
}
