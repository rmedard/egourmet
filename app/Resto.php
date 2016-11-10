<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

    public function getMainPhoto(){
        $s3 = Storage::disk('s3');
        if(!empty($this->mainphoto) and $s3->exists($this->mainphoto)){
            return $s3->url($this->mainphoto);
        }
    }

    public function getOverallVotesCount(){
        return DB::table('dish_resto')->where('resto_id', $this->id)->sum('reviews_count');
    }

    public function getOverallAverageRate(){
        return DB::table('dish_resto')->where('resto_id', $this->id)->avg('average_rate');
    }
}
