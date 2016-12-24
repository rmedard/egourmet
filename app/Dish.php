<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
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

    public function getMainPhoto(){
        $s3 = Storage::disk('s3');
        if(!empty($this->mainphoto) and $s3->exists($this->mainphoto)){
            return $s3->url($this->mainphoto);
        }else{
            return config('constants.nodishimage');
        }
    }
}