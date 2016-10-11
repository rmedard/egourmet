<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

use App\Http\Requests;

class MessagesController extends Controller
{
    public function index(){
        $messages = Message::all();
        return view('admin.data.messages.index', compact('messages'));
    }

    public function store(Request $request){

        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ];

        $messages = [
            'name.required' => 'Votre nom est obligatoire.',
            'email.required' => 'Votre email est obligatoire.',
            'email.email' => 'Votre email est incorect.',
            'message.required' => 'Vous devez indiquer votre message.'
        ];

        $this->validate($request, $rules, $messages);

        return Message::create($request->all());
    }
}
