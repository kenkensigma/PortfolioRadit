<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'message' => 'required|string|max:2000',
        ]);

        Mail::to(env('MAIL_TO_ADDRESS'))->send(
            new ContactMail(
                $request->name,
                $request->email,
                $request->message
            )
        );

        return response()->json([
            'success' => true,
            'message' => 'Your message has been sent!'
        ]);
    }
}
