<?php
/**
 * Created by PhpStorm.
 * User: medard
 * Date: 26/09/16
 * Time: 18:28
 */

namespace App\Repositories\Contracts;


interface DishesContract
{
    public function all();

    public function create(array $dish_data);

    public function find($dish_id);

    public function update($dish_id, array $dish_data);

    public function delete($dish_id);

}