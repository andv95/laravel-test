<?php

namespace App\Http\Controllers;

use App\Events\NewProduct;
use Illuminate\Http\Request;
use Event;

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
}
