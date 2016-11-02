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
use Illuminate\Http\Request;

class RestosRepository implements RestosContract
{

    public function all()
    {
        return Resto::with('address')->orderBy('created_at', 'desc')->paginate(20);
    }

    public function create(array $resto_data)
    {
        return Resto::create($resto_data);
    }

    public function find($resto_id)
    {
        return Resto::with('address')->findOrFail($resto_id);
    }

    public function update(Request $request, $resto_id)
    {
        //$resto = Resto::with('address')->find($resto_id);

        Resto::with('address')->find($resto_id)->update($request);
    }

    public function delete($resto_id)
    {
        Resto::destroy($resto_id);
    }
}