<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\CuisinesContract;
use App\Repositories\Contracts\DishesContract;
use App\Repositories\Contracts\RestosContract;
use App\Resto;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Storage;

class SearchController extends Controller
{
    protected $restosRepo;
    protected $dishesRepo;
    protected $cuisinesRepo;
    private $s3;

    public function __construct(RestosContract $restosContract, DishesContract $dishesContract, CuisinesContract $cuisinesContract){
        $this->restosRepo = $restosContract;
        $this->dishesRepo = $dishesContract;
        $this->cuisinesRepo = $cuisinesContract;
        $this->s3 = Storage::disk('s3');
    }

    public function searchResto(Request $request){
        if(!empty($request->selectedresto)){
            $resto = $this->restosRepo->find($request->selectedresto);
            if(isset($resto->mainphoto) and $this->s3->exists($resto->mainphoto)){
                session(['old_photo' => $resto->mainphoto]);
                $resto->mainphoto = $this->s3->url($resto->mainphoto);
            }else{
                $resto->mainphoto = config('constants.noresto');
            }
            return view('admin.data.restos.edit', compact('resto'));
        }else{
            $restos = $this->restosRepo->all();
            return view('admin.data.restos.index', compact('restos'));
        }
    }

    public function searchDish(Request $request){
        if(!empty($request->selecteddish)){
            $dish = $this->dishesRepo->find($request->selecteddish);
            $dishes_list = $this->cuisinesRepo->all();
            return view('admin.data.dishes.edit', compact('dish', 'dishes_list'));
        }else{
            $dishes = $this->dishesRepo->all();
            return view('admin.data.dishes.index', compact('dishes'));
        }
    }
}
