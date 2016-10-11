<?php
/**
 * Created by PhpStorm.
 * User: medard
 * Date: 26/09/16
 * Time: 18:37
 */

namespace App\Repositories;

use App\Resto;
use App\Repositories\Contracts\RestosContract;

class RestosRepository implements RestosContract
{

    public function all()
    {
        return Resto::with('address')->get();
    }

    public function create(array $resto_data)
    {
        return Resto::create($resto_data);
    }

    public function find($resto_id)
    {
        return Resto::findOrFail($resto_id);
    }

    public function update($resto_id, array $resto_data)
    {
        Resto::find($resto_id)->update($resto_data);
    }

    public function delete($resto_id)
    {
        Resto::destroy($resto_id);
    }
}