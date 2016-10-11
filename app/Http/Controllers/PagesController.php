<?php

namespace App\Http\Controllers;

use App\Dish;
use App\Message;
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
        return view('admin.dashboard', compact('dishesCount', 'restosCount', 'usersCount', 'messagesCount'));
    }
}
