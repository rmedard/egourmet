<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class resto extends Model
{
    protected $fillable = ['address_id', 'name', 'mainphoto', 'tel', 'website', 'facebook', 'enabled'];

    public function address(){
        return $this->belongsTo(Address::class);
    }

    public function dishes(){
        return $this->belongsToMany(Dish::class)
            ->withTimestamps()
            ->withPivot('id', 'enabled', 'average_rate', 'reviews_count');
    }

}
