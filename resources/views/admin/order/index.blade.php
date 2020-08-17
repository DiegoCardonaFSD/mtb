@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                        @include('admin.order.partial.info')
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('order.create') }}" class="btn btn-success">{{ __('CreateOrderBtn') }}</a>
                                <hr>
                            </div>
                        </div>    
                         <div class="row">
                            <div class="col">
                                <table class="table table-striped table-responsive">
                                  <thead>
                                    <tr>
                                      <th scope="col">Orden #</th>
                                      @if($user->rol == "admin")
                                      <th scope="col">Nombre</th>
                                      @endif
                                      <th scope="col">Precio</th>
                                      <th scope="col">EstadoOrden</th>
                                      <th scope="col">EstadoPago</th>
                                      <th scope="col">Acción</th>
                                    </tr>
                                  </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                        <tr>
                                          <th scope="row">{{ $order->id}}</th>
                                          @if($user->rol == "admin")
                                          <td>{{ $order->customer_name}}</td>
                                          @endif
                                          <td>${{ number_format($order->total_price, 0) }} COP</td>
                                          <td>{{ __($order->status_order) }}</td>
                                          <td>{{ __($order->status) }}</td>
                                          <td>
                                            <a href="{{ route('order.show',$order) }}">
                                              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                                                <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                                              </svg>
                                            </a>
                                            @if($order->status == 'CREATED' && $order->status_order == 'NEW')
                                            <a href="{{ route('order.edit',$order->id) }}">
                                               <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z"/>
                                                <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z"/>
                                              </svg>
                                            </a>
                                            @endif
                                            @if($order->status_order == 'NEW')
                                             {!! Form::model($order, ['route' => ['order.destroy', $order->id]]) !!}
                                              @method('DELETE')                                
                                            <a onclick="if(confirm('¿Está seguro que desea eliminar la orden?'))jQuery(this).closest('form').submit()">
                                              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                              </svg>
                                            </a>
                                            {!! Form::close() !!}
                                            @endif
                                          </td>
                                        </tr>
                                        @endforeach
                                      </tbody>
                                    </table>
                                    {!! $orders->render() !!}
                            </div>
                        </div>      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
