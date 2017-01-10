<?php

namespace App\Http\Controllers;

use App\Mail\ContactEgourmet;
use App\Message;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Mail;

class MessagesController extends Controller
{
    public function index(){
        $messages = Message::all();
        return view('admin.data.messages.index', compact('messages'));
    }

    public function store(Request $request){

        $rules = [
            'name' => 'required',
            'emails' => 'required|emails',
            'message' => 'required'
        ];

        $messages = [
            'name.required' => 'Votre nom est obligatoire.',
            'emails.required' => 'Votre emails est obligatoire.',
            'emails.emails' => 'Votre emails est incorect.',
            'message.required' => 'Vous devez indiquer votre message.'
        ];

        $this->validate($request, $rules, $messages);

        return Message::create($request->all());
    }

    public function sendContactEmail(Request $request){
        $rules = [
            'name' => 'required',
            'email' => 'required|emails',
            'message' => 'required'
        ];

        $messages = [
            'name.required' => 'Votre nom est obligatoire.',
            'email.required' => 'Votre emails est obligatoire.',
            'email.emails' => 'Votre emails est incorect.',
            'message.required' => 'Vous devez indiquer votre message.'
        ];

        $this->validate($request, $rules, $messages);

        Mail::from($request->emails)->send(new ContactEgourmet($request->message));
    }
}
