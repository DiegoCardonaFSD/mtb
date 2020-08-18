@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">          

           <h5>{{__('FormResumeBuy')}}</h5>

            <table class="table table-bordered">
            <tbody>
              <tr>
                <th scope="row">{{__('FormName')}}</th>
                <td>{{ $order->customer_name }}</td>
              </tr>
              <tr>
                <th scope="row">{{__('FormEmail')}}</th>
                <td>{{ $order->customer_email }}</td>
              </tr>
              <tr>
                <th scope="row">{{__('FormMobile')}}</th>
                <td>{{ $order->customer_mobile }}</td>
              </tr>
              <tr>
                <th scope="row">{{__('FormAddress')}}</th>
                <td>{{ $order->address }}</td>
              </tr>
              <tr>
                <th scope="row">{{__('FormQuantity')}}</th>
                <td>{{ $order->quantity }}</td>
              </tr>
              <tr>
                <th scope="row">{{__('FormTotalPrice')}}</th>
                <td>${{ number_format($order->total_price, 0) }} COP</td>
              </tr>
              
            </tbody>
          </table>
          <hr>
            <div class="card text-center" style="width: 18rem;">
              <img src="/image/1.jpg" class="card-img-top">
              <div class="card-body">
                <h5 class="card-title">{!! $order->product->name !!}</h5>
                <h3 class="card-text text-right">
                 {{__('FormPricePerProduct')}} ${{ number_format($order->product->price, 0) }} COP
                </h3>
              </div>
            </div>
            <hr>

            {!! Form::open(['route' => ['payment.create', $order->id]]) !!}
            <button type="submit" class="btn btn-success">{{ __('PayWithPlaceToPay') }}</button>
            <a href="{{ route('order.edit',$order->id) }}" class="btn btn-primary">{{ __('BackBtn') }}</a>
            {!! Form::close() !!}

            
            <hr>


        </div>
    </div>
    
</div>
@endsection










  