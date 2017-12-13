<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactFormRequest;
use Illuminate\Container\Container;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
  public function create()
  {
      return view('contact');
  }

  public function store(ContactFormRequest $request)
  {
    \Mail::send('contact.email',
        array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'user_message' => $request->get('message')
        ), function($message)
    {
        $message->from('noreply@nordicdh-beta.org');
        $message->to('bradymh23@gmail.com', 'Admin')->subject('NordicDH Feedback');
    });

    $name = 'test';
    $email = 'test';
    $user_message = 'test';
    $markdown = Container::getInstance()->make(Markdown::class);
    $html = $markdown->render('contact.email', compact('name', 'email', 'user_message'));
    Log::info('HTML -->  ' . $html);
    return \Redirect::route('contact')->with('message', 'Thank you for contacting us! We will respond to your message as soon as possible.');
  }
}
