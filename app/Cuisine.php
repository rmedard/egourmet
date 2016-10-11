<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuisine extends Model
{
    protected $fillable = ['name'];

    public function dishes(){
        return $this->hasMany(Dish::class);
    }
}
