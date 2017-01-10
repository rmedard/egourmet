<?php

namespace App\Http\Controllers;

use App\Mail\ContactEgourmet;
use App\Mail\WelcomeToEgourmet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailsController extends Controller
{
    public function sendWelcomeMail(){
        Mail::to('medard.rebero@gmail.com')->send(new WelcomeToEgourmet());
    }

    public function sendContactEmail(Request $request){
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

        return Mail::to(config('constants.contactemail'))->send(new ContactEgourmet($request->message, $request->email));
    }
}