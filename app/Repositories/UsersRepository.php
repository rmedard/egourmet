<?php
/**
 * Created by PhpStorm.
 * User: medard
 * Date: 27/09/16
 * Time: 18:23
 */

namespace App\Repositories;

use App\Repositories\Contracts\UsersContract;
use App\User;

class UsersRepository implements UsersContract
{

    public function all()
    {
        return User::all();
    }

    public function create(array $user_data)
    {
        return User::create($user_data);
    }

    public function find($user_id)
    {
        return User::findOrFail($user_id);
    }

    public function update($user_id, array $user_data)
    {
        User::find($user_id)->update($user_data);
    }

    public function delete($user_id)
    {
        User::destroy($user_id);
    }
}