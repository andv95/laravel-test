<?php

namespace App\Http\Controllers;

use App\Events\NewProduct;
use App\Jobs\SendEmailNewUserJob;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Event;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


class PageController extends Controller
{
    public function eventListener() {
        return view('event_listener');
    }

    public function eventListenerAction() {
        $product = array();
        $product['id'] = "P001";
        $product['name'] = "Jeans";
        $product['size'] = "30x30";
        $product['color'] = "Black";
        $product['price'] = "1.200.000";
        event(new NewProduct($product));
        return redirect()->route('success');
    }

    public function sendMail(Request $request) {
        $input = $request->all();

//        Mail::to('an.doan.1232@gmail.com')->send(new SendMail());
        Mail::send('send_mail_success', array('name'=>$input["name"],'email'=>$input["email"], 'comment'=>$input['comment']), function($message){
            $message->to('an.doan.1232@gmail.com')->subject('Test send email');
        });
//        Session::flash('flash_message', 'Send message successfully!');
        return view('send-mail');
    }
}
