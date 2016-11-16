<?php

namespace App\Http\Controllers;

use App\Cuisine;
use App\Dish;
use App\Repositories\Contracts\CuisinesContract;
use App\Repositories\Contracts\DishesContract;
use Illuminate\Http\Request;

use App\Http\Requests;

class DishesController extends Controller
{
    protected $dishesRepo;
    protected $cuisinesRepo;

    private $rules = [
        'name' => ['required'],
        'cuisine' => ['required']
    ];
    /**
     * DishesController constructor.
     * @param $dishesRepo
     */
    public function __construct(DishesContract $dishesContract, CuisinesContract $cuisinesContract)
    {
        $this->dishesRepo = $dishesContract;
        $this->cuisinesRepo = $cuisinesContract;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dishes = $this->dishesRepo->all();
        return view('admin.data.dishes.index', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dishes_list = $this->cuisinesRepo->all();
        return view('admin.data.dishes.create', compact('dishes_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules, array(
            'name.required' => trans('messages.searchdish_required'),
            'cuisine.required' => trans('messages.cuisine_required')
        ));


        if ($request->ajax()){
            $cuisine = Cuisine::firstOrCreate(['name' => $request->cuisine]);
        }else{
            $cuisine = Cuisine::find($request->cuisine);
        }

        $dish = Dish::firstOrCreate(['name' => $request->name, 'cuisine_id' => $cuisine->id]);
        $dish->enabled = true;
        $cuisine->dishes()->save($dish);

        if($request->ajax()){
            $results[] = ['id'=>$dish->id,'value'=>$dish->name];
            return $results;
        }else{
            $dishes = $this->dishesRepo->all();
            session()->flash('flash_message', trans('messages.dish_creat_success'));
            return redirect()->route('dishes.index', compact($dishes));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        //$dish = Dish::find($id);
        
        return $dish;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dish = $this->dishesRepo->find($id);
        $dishes_list = $this->cuisinesRepo->all();
        return view('admin.data.dishes.edit', compact('dish', 'dishes_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules, array(
            'name.required' => trans('messages.searchdish_required'),
            'cuisine.required' => trans('messages.cuisine_required')
        ));

        $cuisine = Cuisine::find($request->cuisine);

        $dish = Dish::find($id);
        $dish->name = $request->name;
        $dish->enabled = true;
        $cuisine->dishes()->save($dish);

        if($request->ajax()){
            $results[] = ['id'=>$dish->id,'value'=>$dish->name];
            return $results;
        }else{
            $dishes = $this->dishesRepo->all();
            session()->flash('flash_message', trans('messages.dish_update_success'));
            return redirect()->route('dishes.index', compact($dishes));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Retreives Pivot (DishResto) values
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pivots(){
        $dishes = Dish::has('restos')->get();
        return view('welcome', compact('dishes'));
    }
    
}
