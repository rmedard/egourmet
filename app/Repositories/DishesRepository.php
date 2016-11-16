<?php
/**
 * Created by PhpStorm.
 * User: medard
 * Date: 26/09/16
 * Time: 18:38
 */

namespace App\Repositories;


use App\Dish;
use App\Repositories\Contracts\DishesContract;

class DishesRepository implements DishesContract
{

    public function all()
    {
        return Dish::with('cuisine')->orderBy('name', 'asc')->paginate(20);
    }

    public function create(array $dish_data)
    {
        return Dish::create($dish_data);
    }

    public function find($dish_id)
    {
        return Dish::with('cuisine')->findOrFail($dish_id);
    }

    public function update($dish_id, array $dish_data)
    {
        Dish::find($dish_id)->update($dish_data);
    }

    public function delete($dish_id)
    {
        Dish::destroy($dish_id);
    }

}