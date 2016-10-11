<?php
/**
 * Created by PhpStorm.
 * User: medard
 * Date: 26/09/16
 * Time: 18:30
 */

namespace App\Repositories\Contracts;


interface UsersContract
{
    public function all();

    public function create(array $user_data);

    public function find($user_id);

    public function update($user_id, array $user_data);

    public function delete($user_id);
}