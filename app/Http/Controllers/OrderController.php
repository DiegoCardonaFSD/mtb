<?php

namespace App\Http\Controllers;


use Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Services\Payments\PaymentAdapter;
use App\Services\Payments\PlaceToPay;
use App\Order;
use App\Product;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = (new Order())->roleCondition()->orderBy('id', 'DESC')->paginate();
        return view('admin.order.index', [
            'orders'    => $orders,
            'user'      => auth()->user()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = Product::first();
        return view('admin.order.create', [
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
        $order->product_id  = $product->id;
        $order->user_id     = auth()->user()->id;
        $order->total_price = $order->quantity * $product->price;
        $order->uuid        = Str::uuid()->toString();
        $order->save();

        return redirect()->route('order.preview', $order);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        if(
            $order->status_order == env('ORDER_STATUS_PROCESSING') &&
            (
                $order->status == env('ORDER_STATUS_CREATED') ||
                $order->status == env('ORDER_STATUS_REJECTED')
            )
        ){
            $data['order'] = $order;
            $paymentAdapter = new PaymentAdapter(new PlaceToPay($data));
            $paymentAdapter->get(); 
            $order = $order->fresh();
        }

        return view('admin.order.show', [
            'order'     => $order,
        ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */

    public function preview(Order $order)
    {
        return view('admin.order.preview', [
            'order'     => $order,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $product    = Product::first();
        $user       = auth()->user();
        return view('admin.order.edit', [
            'product'   => $product,
            'user'      => $user,
            'order'     => $order,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, Order $order)
    {
        $product = Product::findOrFail($request->product_id);

        $order->fill($request->all());
        $order->total_price = $order->quantity * $product->price;
        $order->save();

        return redirect()->route('order.preview', $order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return back()->with('info', __('DestroyConfirmation'));
    }
}
