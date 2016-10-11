<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Dish extends Model
{
    Use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'dishes.name' => 10
        ]
    ];

    protected $fillable = ['name', 'mainphoto', 'cuisine_id', 'enabled'];

    public function cuisine(){
        return $this->belongsTo(Cuisine::class);
    }

    public function restos(){
        return $this->belongsToMany(Resto::class)
            ->withTimestamps()
            ->withPivot('id', 'enabled', 'average_rate', 'reviews_count');
    }
}