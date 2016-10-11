<?php

namespace App;


use Illuminate\Database\Eloquent\Relations\Pivot;

class DishResto extends Pivot
{
    public function ratings(){
        return $this->hasMany(Rating::class);
    }
}