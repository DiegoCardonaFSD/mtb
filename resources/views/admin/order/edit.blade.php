@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('CreateOrder') }}</div>

                <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
  
                         <div class="row">
                            <div class="col">
                                {!! Form::model($product, ['order.update', $order->id, 'method' => 'PUT']) !!}

                               @include('admin.order.edit') 

                                {!! Form::close() !!}

                            </div>
                        </div>      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection