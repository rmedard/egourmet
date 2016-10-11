<?php
/**
 * Created by PhpStorm.
 * User: medard
 * Date: 26/09/16
 * Time: 18:27
 */

namespace App\Repositories\Contracts;


interface RestosContract
{
    public function all();

    public function create(array $resto_data);

    public function find($resto_id);

    public function update($resto_id, array $resto_data);

    public function delete($resto_id);
}