@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">          

           <h5>{{__('FormResumeView')}}</h5>

            <table class="table table-bordered">
            <tbody>
              <tr>
                <th scope="row">{{__('FormDocumentType')}}</th>
                <td>{{ $order->document_type }}</td>
              </tr>
              <tr>
                <th scope="row">{{__('FormDocument')}}</th>
                <td>{{ $order->document }}</td>
              </tr>
              <tr>
                <th scope="row">{{__('FormName')}}</th>
                <td>{{ $order->customer_name }}</td>
              </tr>
              <tr>
                <th scope="row">{{__('FormLastName')}}</th>
                <td>{{ $order->customer_lastname }}</td>
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

               @if( 
                    $order->status_order != env('ORDER_STATUS_NEW') &&
                    $order->status != env('ORDER_STATUS_CREATED')
                    
                )
              <tr>
                <th scope="row">{{__('FormStatusOrder')}}</th>
                <td>{{ __($order->status) }}</td>
              </tr>
              @endif
              
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

            @if( 
                (
                  $order->status_order == env('ORDER_STATUS_PROCESSING') &&
                  $order->status == env('ORDER_STATUS_CREATED')
                ) ||
                (
                  $order->status_order == env('ORDER_STATUS_NEW') &&
                  $order->status == env('ORDER_STATUS_REJECTED')
                ) ||
                (
                  $order->status_order == env('ORDER_STATUS_NEW') &&
                  $order->status == env('ORDER_STATUS_CREATED')
                )
            )
               {!! Form::open(['route' => ['payment.create', $order->id]]) !!}
              <button type="submit" class="btn btn-success">{{ __('PayWithPlaceToPay') }}</button>
              <a href="{{ route('order.list') }}" class="btn btn-primary">{{ __('BackBtn') }}</a>
              {!! Form::close() !!}
            @else
            <a href="{{ route('order.list') }}" class="btn btn-primary">{{ __('BackBtn') }}</a>
            @endif
            <hr>


        </div>
    </div>
    
</div>
@endsection










  