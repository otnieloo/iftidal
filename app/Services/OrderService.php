<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderService
{

    public function dataTable(Request $request)
    {

        // Check the role
        $vendorId = $request->user()->vendor_id;


        $columns = ['orders.id', 'users.name', 'orders.event_name', 'locations.location', 'orders.event_date', 'orders.grand_total'];

        // Page Information
        $pageLength = $request->length;

        // Order Information
        (int) $orderColumnIndex = $request->order[0]['column'] ?? 0;
        $orderBy                = $request->order[0]['dir'] ?? 'desc';
        $orderByName            = $columns[$orderColumnIndex];


        // Query to database
        $search = $request->search['value'];
        $query  = Order::select($columns)
            ->join('users', 'orders.user_id', 'users.id')
            ->join('locations', 'orders.location_id', 'locations.id')
            ->where(function ($query) use ($search, $columns) {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'like', "%" . $search . "%");
                }
            });



        if ($vendorId) {
            $query->whereHas('order_products', function ($q) use ($vendorId) {
                $q->where('vendor_id', $vendorId);
            });
        }

        $query = $query->orderBy($orderByName, $orderBy)
            ->paginate((int) $pageLength);

        // Drawing rows
        $rows = [];
        foreach ($query->items() as $item) {
            $row   = array();
            $row[] = "<input type='checkbox' class='order-checkbox' value='{$item->id}' />";
            $row[] = $item->id;
            $row[] = 'ORDER ID';
            $row[] = $item->event_name;
            $row[] = $item->location;
            $row[] = $item->event_date;
            $row[] = $item->grand_total;

            $rows[] = $row;
        }


        return [
            "draw" => $request->draw,
            "recordsTotal" => $query->total(),
            "recordsFiltered" => $query->total(),
            'data' => $rows
        ];
    }
}
