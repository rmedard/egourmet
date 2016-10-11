<?php

namespace App\Http\Controllers;

use App\Dish;
use App\Repositories\Contracts\DishesContract;
use Illuminate\Http\Request;

use App\Http\Requests;

class DishesController extends Controller
{
    protected $dishesRepo;

    /**
     * DishesController constructor.
     * @param $dishesRepo
     */
    public function __construct(DishesContract $dishesRepo)
    {
        $this->dishesRepo = $dishesRepo;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
        //
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
        //
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
