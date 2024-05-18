<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\WelcomMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendmail()
    {
        $data=[
            'subject'=>'orientspark welcom',
            'body'=>'wellcom my client',
        ];
        try {
            Mail::to('mohamedsaeed_mso11@yahoo.com')->send(new WelcomMail($data));
            dd('good');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }

        // return view('emails.welcom_emails');
    }
}
