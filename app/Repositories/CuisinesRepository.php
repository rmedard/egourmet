<?php
/**
 * Created by PhpStorm.
 * User: medard
 * Date: 28/09/16
 * Time: 23:27
 */

namespace App\Repositories;


use App\Cuisine;
use App\Repositories\Contracts\CuisinesContract;

class CuisinesRepository implements CuisinesContract
{

    public function all()
    {
        return Cuisine::pluck('name', 'id');
    }
}