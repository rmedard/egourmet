<?php

namespace App\Http\Controllers;

use App\Dish;
use App\Message;
use App\Repositories\Contracts\DishesContract;
use App\Repositories\Contracts\RestosContract;
use App\Resto;
use App\Rating;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $dishRepo;
    protected $restoRepo;
    public $message;

    public function __construct(DishesContract $dishRepo, RestosContract $restoRepo)
    {
        $this->message = null;
        $this->dishRepo = $dishRepo;
        $this->restoRepo = $restoRepo;
    }

    public function home(){
        $dishes = null;
        $message = $this->message;
        return view('home', compact('dishes', 'message'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dishes = Dish::where('enabled', 1)->get();
        //$dishes = Resto::belongsToMany(Dish::class)->wherePivot('enabled', 1);
        $dishes_list = Dish::where('enabled', 1)->pluck('name', 'id');
        $restos_list = Resto::where('enabled', 1)->pluck('name', 'id');
        return view('welcome', compact('dishes', 'dishes_list', 'restos_list'));
    }

    public function persist(Request $request){
        $persist_type = $request->input('persist_type');
        if(strcmp($persist_type, 'rating') == 0){
            $rating = ['dish_resto_id' => $request->input('dish_resto_id'),
                'email' => $request->input('rating-email'),
                'value' => $request->input('rating-value'),
                'comment' => $request->input('rating-comment')];
            $ratingStored = Rating::create($rating);
            $dish = $this->dishRepo->find($request->input('dish_id'));
            $resto = $this->restoRepo->find($request->input('resto_id'));
            $reviewsCount = 0;
            $rateAverage = 0;
            foreach ($dish->restos as $res){
                if($res->id == $resto->id){
                    $reviewsCount = $res->pivot->reviews_count;
                    $rateAverage = $res->pivot->average_rate;
                }
            }
            return array(array_merge($ratingStored->getAttributes(), ['reviews_count' => $reviewsCount, 'rate_average' => $rateAverage]));
        }
    }

    public function dish_autocomplete(Request $request){
        if($request->ajax()){
            $message = null;
            $results = array();
            $dishItem = $request->input(['term']);
            $dishes = Dish::where('name','LIKE','%'.$dishItem.'%')->where('enabled', 1)->take(5)->get();
            foreach ($dishes as $dish) {
                $results[] = ['id'=>$dish->id,'value'=>$dish->name];
            }
            return response()->json($results);
        }
    }

    public function resto_autocomplete(Request $request){
        if($request->ajax()){
            $results = array();
            $restoItem = $request->input(['term']);
            $restos = Resto::where('name','LIKE','%'.$restoItem.'%')->where('enabled', 1)->take(10)->get();
            foreach ($restos as $resto) {
                $results[] = ['id'=>$resto->id,'value'=>$resto->name];
            }
            return response()->json($results);
        }
    }

    public function search(Request $request){
        $selectedDishId = $request->input(['selecteddish']);
        $selectedRestoId = $request->input(['selectedresto']);
        $dishes = new Collection();
        if ($selectedDishId){
            if ($selectedRestoId){
                $dish = Dish::where('id', $selectedDishId)->with(['restos' => function ($query) use ($selectedRestoId){
                    $query->wherePivot('enabled', true)->wherePivot('resto_id', $selectedRestoId);
                }])->first();

                if($dish and !$dish->restos->isEmpty()){
                    $dishes = collect([$dish]);
                }
            }else{
                $dishes = Dish::where('id', $selectedDishId)->with(['restos' => function ($query){
                    $query->wherePivot('enabled', true)->orderBy('average_rate', 'desc');
                }])->get();
            }
        }elseif ($selectedRestoId){
            $dishes = Dish::with(['restos' => function ($query) use ($selectedRestoId){
                $query->wherePivot('enabled', true)->wherePivot('resto_id', $selectedRestoId)->orderBy('average_rate', 'desc');
            }])->get();
        }
        $message = $this->message;
        return view('home', compact('dishes', 'message'));
    }

    public function homeform(){
        return view('homeform', compact('message'));
    }
}