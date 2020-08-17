<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests\OrderRequest;


use App\Order;
use App\Product;

class BuyController extends Controller
{
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = Product::first();
        return view('admin.buy.create', [
            'product' => $product
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $product = Product::findOrFail($request->product_id);
        // store
        $order = new order($request->all());
        $order->product_id = $product->id;
        $order->user_id = auth()->user()->id;
        $order->total_price = $order->quantity * $product->price;
        $order->save();

        return redirect()->route('buy.preview', $order);
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */

    public function preview(Order $order)
    {
        return view('admin.buy.preview', [
            'order'     => $order,
        ]);
    }

    
}
