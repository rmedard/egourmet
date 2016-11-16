<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Dish extends Model
{
    Use SearchableTrait;
    Use Sluggable;

    protected $searchable = [
        'columns' => [
            'dishes.name' => 10
        ]
    ];

    protected $fillable = ['name', 'mainphoto', 'cuisine_id', 'enabled'];

    public function sluggable(){
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function cuisine(){
        return $this->belongsTo(Cuisine::class);
    }

    public function restos(){
        return $this->belongsToMany(Resto::class)
            ->withTimestamps()
            ->withPivot('id', 'enabled', 'average_rate', 'reviews_count');
    }
}