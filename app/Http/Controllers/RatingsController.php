<?php

namespace App\Http\Controllers;

use App\Dish;
use App\Rating;
use App\Repositories\Contracts\CuisinesContract;
use App\Resto;
use Illuminate\Http\Request;

use App\Http\Requests;

class RatingsController extends Controller
{
    protected $cuisinesRepo;

    public function __construct(CuisinesContract $cuisinesContract){
        $this->cuisinesRepo = $cuisinesContract;
    }

    private $rules = [
        'searchdish' => ['required', 'exists:dishes,name'],
        'searchresto' => ['required', 'exists:restos,name'],
        'ratingemail' => ['required', 'email'],
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
            'searchdish.required' => trans('messages.searchdish_required'),
            'searchdish.exists' => trans('messages.searchdish_exists'),
            'searchresto.required' => trans('messages.searchresto_required'),
            'searchresto.exists' => trans('messages.searchresto_exists'),
            'ratingemail.required' => trans('messages.rating_email_required'),
            'ratingemail.email' => trans('messages.rating_email_email'),
            ));
        $resto = Resto::find($request->selectedresto);
        $resto->dishes()->syncWithoutDetaching([$request->selecteddish => ['enabled' => true]]);
        $pivotId = $resto->dishes()->find($request->selecteddish)->pivot->id;
        $rating = new Rating();
        $rating->dish_resto_id = $pivotId;
        $rating->value = empty($request->ratingvalue) ? 0 : $request->ratingvalue;
        $rating->email = $request->ratingemail;
        $rating->comment = $request->ratingcomment;
        $rating->save();
        session()->flash('flash_message', trans('messages.evaluation_success'));
        $cuisines_list = $this->cuisinesRepo->all();
        return redirect()->route('home.home')->with('cuisines_list', $cuisines_list);
    }

    public function ratings(){
        $restos = Resto::has('dishes')->orderBy('name', 'asc')->paginate(10);
        return view('admin.data.ratings', compact('restos'));
    }
}
