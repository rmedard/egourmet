<?php
/**
 * Created by PhpStorm.
 * User: medard
 * Date: 07/10/16
 * Time: 00:10
 */

namespace App\Repositories;


use App\Address;
use App\Repositories\Contracts\AddressesContract;

class AddressesRepository implements AddressesContract
{

    public function create(array $address_data){
        return Address::create($address_data);
    }
}