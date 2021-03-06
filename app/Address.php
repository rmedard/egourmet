<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    protected $fillable = ['rue', 'numero', 'codepostal', 'commune', 'pays', 'exists', 'latitude', 'longitude'];

    public function resto(){
        return $this->hasOne(Resto::class);
    }

    public function display(){
        return $this->rue . ' ' . $this->numero . ', ' . $this->codepostal . ' ' . $this->commune;
    }
}
