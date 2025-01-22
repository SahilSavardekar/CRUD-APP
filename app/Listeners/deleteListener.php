<?php

namespace App\Listeners;

use App\Events\deleteProduct;
use App\Models\DeletedProduct;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class deleteListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(deleteProduct $event): void
    {
        //
        $product = $event->product;

        if (DeletedProduct::create([
            'name' => $product->name,
            'product_id' => $product->id,
            'qty' => $product->qty,
            'price' => $product->text,
            'description' => $product->description,
        ])) {
            Log::info('ProductDeleted event triggered', ['product' => $product->toArray()]);
        } else {
            Log::info('something error');
        }
    }
}
