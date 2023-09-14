<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\GenMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\GenClass;

class ContactController extends Controller
{
   
    public function contact_message(Request $request){
    
    $formFields = $request->validate([
	'name' => ['required', 'min:3'],
	'email' => ['required', 'email'],
    'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
    'subject' => ['required', 'min:3'],
    'message' => ['required', 'min:3']
	]);	

	/*	Newsletter::create($formFields);*/

	$subject = "Ticket #" . GenClass::gen("ticket_id") . ": " . $formFields["subject"];
	$message = "<p>Dear " . $formFields["name"] . ",</p><p>Thank you for using our customer support service.</p><p>We will get back to you as soon as possible.</p>";
	Mail::to($formFields["email"])->send(new GenMail($subject,  $message, GenClass::$gen_email));

	$subject = "Ticket #" . GenClass::gen("ticket_id") . ": " . $formFields["subject"];
	$message = "<p><b>Name:</b> " . $formFields["name"] . "</p><p><b>Email:</b> " . $formFields["email"] . "</p><p><b>Phone Number:</b> " . $formFields["phone"] . "</p><p>" . $formFields["message"] . "</p>";
	Mail::to(GenClass::$gen_email)->send(new GenMail($subject,  $message, $formFields["email"]));
    
	return redirect(url()->previous())->with('success', 'Message successfully sent!');
    }

}
