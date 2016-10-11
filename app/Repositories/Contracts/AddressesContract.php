<?php
/**
 * Created by PhpStorm.
 * User: medard
 * Date: 07/10/16
 * Time: 00:09
 */

namespace App\Repositories\Contracts;


interface AddressesContract
{
    public function create(array $address_data);
}