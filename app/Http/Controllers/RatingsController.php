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

    public function ratingsChartData(){
        $jan = Rating::whereMonth('created_at', '=', 1)->whereYear('created_at', '=', date('Y'))->count();
        $feb = Rating::whereMonth('created_at', '=', 2)->whereYear('created_at', '=', date('Y'))->count();
        $mar = Rating::whereMonth('created_at', '=', 3)->whereYear('created_at', '=', date('Y'))->count();
        $apr = Rating::whereMonth('created_at', '=', 4)->whereYear('created_at', '=', date('Y'))->count();
        $may = Rating::whereMonth('created_at', '=', 5)->whereYear('created_at', '=', date('Y'))->count();
        $jun = Rating::whereMonth('created_at', '=', 6)->whereYear('created_at', '=', date('Y'))->count();
        $jul = Rating::whereMonth('created_at', '=', 7)->whereYear('created_at', '=', date('Y'))->count();
        $aug = Rating::whereMonth('created_at', '=', 8)->whereYear('created_at', '=', date('Y'))->count();
        $sep = Rating::whereMonth('created_at', '=', 9)->whereYear('created_at', '=', date('Y'))->count();
        $oct = Rating::whereMonth('created_at', '=', 10)->whereYear('created_at', '=', date('Y'))->count();
        $nov = Rating::whereMonth('created_at', '=', 11)->whereYear('created_at', '=', date('Y'))->count();
        $dec = Rating::whereMonth('created_at', '=', 12)->whereYear('created_at', '=', date('Y'))->count();

        $year_count = Rating::whereYear('created_at', '=', date('Y'))->count();

        $data = [
            'labels' => [
                trans('gui.month.january'),
                trans('gui.month.february'),
                trans('gui.month.march'),
                trans('gui.month.april'),
                trans('gui.month.may'),
                trans('gui.month.june'),
                trans('gui.month.july'),
                trans('gui.month.august'),
                trans('gui.month.september'),
                trans('gui.month.october'),
                trans('gui.month.november'),
                trans('gui.month.december'),
            ],

            'datasets' => [
                [
                    'label' => trans('gui.count.ratings.year', ['year' => date('Y')]),
                    'fillColor'=> "rgba(120,120,120,0.5)",
                    'strokeColor'=> "rgba(120,120,120,0.8)",
                    'highlightFill'=> "rgba(120,120,120,0.75)",
                    'highlightStroke'=> "rgba(120,120,120,1)",
                    'data' => [$jan, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec]
                ],
            ],

            'custom' => [
                'year' => date('Y'),
                'yearCount' => $year_count
            ]
        ];
        return response()->json($data);
    }
}
