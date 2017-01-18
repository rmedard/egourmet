<?php

namespace App\Http\Controllers;

use App\Dish;
use App\Message;
use App\Rating;
use App\Resto;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function home(){
        return view('home');
    }

    public function about(){
        return view('about');
    }

    public function dashboard(){
        $dishesCount = Dish::all()->count();
        $restosCount = Resto::all()->count();
        $usersCount = User::all()->count();
        $messagesCount = Message::all()->count();
        $ratingsPerYear = array();
        for ($year = 2016; $year <= date('Y'); $year++){
            $ratingsPerYear[$year] = $this->getRatingsPerYear($year);
        }
        $totalRatingsCount = Rating::count();
        return view('admin.dashboard', compact('dishesCount', 'restosCount', 'usersCount', 'messagesCount', 'ratingsPerYear', 'totalRatingsCount'));
    }

    private function getRatingsPerYear($year){
        return Rating::whereYear('created_at', '=', $year)->count();
    }
}
