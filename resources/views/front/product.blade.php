@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="image/1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="image/2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="image/3.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="image/4.jpg" class="d-block w-100" alt="...">
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
              </a>
            </div>
        </div>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h4>
                <span>
                    {!! $product->name !!} &nbsp;
                    ${{ number_format($product->price, 0) }} COP
                </span>
            </h4>
        </div>
    </div>
    <br>
    @include('front.partials.buy') 
    <div class="row justify-content-center">
        <div class="col-md-8">
            {!! $product->description !!}
            </h4>
        </div>
    </div>
    @include('front.partials.buy') 
</div>
@endsection
