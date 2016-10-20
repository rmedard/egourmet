<?php

namespace App\Http\Controllers;

use App\Dish;
use App\DishResto;
use App\Rating;
use App\Resto;
use Illuminate\Http\Request;

use App\Http\Requests;

class RatingsController extends Controller
{
    private $rules = [
        'searchdish' => ['required'],
        'searchresto' => ['required'],
        'rating-email' => ['required', 'email'],
    ];

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules, array(
                'searchdish.required' => trans('gui.searchdish_required'),
                'searchresto.required' => trans('gui.searchresto_required'),
                'rating-email.required' => trans('gui.rating_email_required'),
                'rating-email.email' => trans('gui.rating_email_email')
            ));

        $dish = Dish::find($request->selecteddish);
        $resto = Resto::find($request->selectedresto);
    }

}
