<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class resto extends Model
{
    use Sluggable;

    protected $fillable = ['address_id', 'name', 'mainphoto', 'tel', 'website', 'facebook', 'enabled'];

    public function sluggable(){
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function address(){
        return $this->belongsTo(Address::class);
    }

    public function dishes(){
        return $this->belongsToMany(Dish::class)
            ->withTimestamps()
            ->withPivot('id', 'enabled', 'average_rate', 'reviews_count');
    }

    public function getMainPhotoURL(){
        $s3 = Storage::disk('s3');
        if(!empty($this->mainphoto)){
            if(filter_var($this->mainphoto, FILTER_VALIDATE_URL)){
                return $this->mainphoto;
            }elseif ($s3->exists($this->mainphoto)){
                return $s3->url($this->mainphoto);
            }else{
                return config('constants.norestoimage');
            }
        }else{
            return config('constants.norestoimage');
        }
    }

    public function getOverallVotesCount(){
        return DB::table('dish_resto')->where('resto_id', $this->id)->sum('reviews_count');
    }

    public function getOverallAverageRate(){
        return round(DB::table('dish_resto')->where('resto_id', $this->id)->avg('average_rate'), 2);
    }
}
