<?php

namespace App\Listeners;

use App\Events\NewProduct;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class SendEmailAfterNewProduct
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NewProduct  $event
     * @return void
     */
    public function handle(NewProduct $event)
    {
        sleep(60);
        $date = date("Ymd_hi");
        $fileName = $event->product['id']. '_'. $date. 'txt';
        $data = "name: {$event->product['name']}, size: {$event->product['size']}, color: {$event->product['color']}, price: {$event->product['color']}";
        Storage::disk('local')->put($fileName, $data);
        return true;
    }
}
