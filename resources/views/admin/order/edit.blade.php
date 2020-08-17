@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('EditOrder') }}</div>

                <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                           <div class="col">
                             @include('admin.order.error')
                           </div>
                         </div>
                         <div class="row">
                            <div class="col">
                               {!! Form::model($order, ['route' => ['order.update', $order->id]]) !!}
                                @method('PUT')

                                @include('admin.order.form')
                               

                                {!! Form::close() !!}

                            </div>
                        </div>      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection