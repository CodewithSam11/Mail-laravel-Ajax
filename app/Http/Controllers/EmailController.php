<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\FirstEmail;

class EmailController extends Controller
{
    public function email()
    {
        // dd('hello');
        $data = [
            'greeting' => 'Hello! Mohd Suhail Ansari',
            'message' => 'This is your first email sent from Laravel!',
        ];

        // Send the email
        Mail::to('sam482217@gmail.com')->send(new FirstEmail($data));

        return "Email sent!";
    }

    public function hello()
    {
        return view('home');
    }
}
