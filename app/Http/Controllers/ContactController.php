<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class ContactController extends Controller
{
    public function contact()
    {
        return view('contact');
    }

    public function sendContact(Request $request)
    {
        \Mail::send('contactMail', array(
            'email' => $request->email,
            'name' => $request->name,
            'msg' => $request->message,
        ), function($message) use ($request){
            $message->from($request->email);
            $message->to('gabriel.silva@codejr.com.br', 'Gabriel Silva')->subject($request->get('subject'));
        });

        return redirect()->route('contact')->with('success', true);
    }
}
