<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Log;

class OrderProductObserver
{
    /**
     * Handle the OrderProduct "created" event.
     *
     * @param  \App\Models\OrderProduct  $orderProduct
     * @return void
     */
    public function created(OrderProduct $orderProduct)
    {
        $order = Order::onCreated()->first();

        $sumOrder = OrderProduct::selectRaw('SUM(total_capital_price) as total_capital_price, SUM(total_sell_price) as total_sell_price, SUM(product_discount_price) as total_discount_price, SUM(grand_total) as grand_total')
        ->where('order_id', $order->id)
        ->first();
        
        $data = [
            'total_price_capital' => $sumOrder->total_capital_price,
            'total_price_sell'    => $sumOrder->total_sell_price,
            'total_discount'      => $sumOrder->total_discount_price,
            'grand_total'         => $sumOrder->grand_total
        ];


        $order->update($data);
    }

    /**
     * Handle the OrderProduct "updated" event.
     *
     * @param  \App\Models\OrderProduct  $orderProduct
     * @return void
     */
    public function updated(OrderProduct $orderProduct)
    {
        $order = Order::onCreated()->first();

        $sumOrder = OrderProduct::selectRaw('SUM(total_capital_price) as total_capital_price, SUM(total_sell_price) as total_sell_price, SUM(product_discount_price) as total_discount_price, SUM(grand_total) as grand_total')
        ->where('order_id', $order->id)
        ->first();
        
        $data = [
            'total_price_capital' => $sumOrder->total_capital_price,
            'total_price_sell'    => $sumOrder->total_sell_price,
            'total_discount'      => $sumOrder->total_discount_price,
            'grand_total'         => $sumOrder->grand_total
        ];


        $order->update($data);
    }

    /**
     * Handle the OrderProduct "deleted" event.
     *
     * @param  \App\Models\OrderProduct  $orderProduct
     * @return void
     */
    public function deleted(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Handle the OrderProduct "restored" event.
     *
     * @param  \App\Models\OrderProduct  $orderProduct
     * @return void
     */
    public function restored(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Handle the OrderProduct "force deleted" event.
     *
     * @param  \App\Models\OrderProduct  $orderProduct
     * @return void
     */
    public function forceDeleted(OrderProduct $orderProduct)
    {
        //
    }
}
