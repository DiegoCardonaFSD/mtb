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
                             @include('admin.order.error')
                           </div>
                         </div>
                         <div class="row">
                            <div class="col">
                                {!! Form::open(['route' => ['order.store']]) !!}

                                @include('admin.order.form') 

                                  <button type="submit" class="btn btn-success">{{__('FormSendEditBtn')}}</button>
                                  <a href="{{ route('order.list') }}" class="btn btn-primary">{{ __('BackBtn') }}</a>

                                  <hr>

                                {!! Form::close() !!}
                            </div>
                        </div>      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
