@extends('layout')
@section('title', 'VIP WORLD TRADING')
@section('content')
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- error-403 start-->
      <div class="error-wrapper">
        <div class="container"><img class="img-100" src="{{ asset('images/sad.png') }}" alt="">
          <div class="error-heading">
            <h2 class="headline font-danger">404</h2>
          </div>
          <div class="col-md-8 offset-md-2">
            <p class="sub-content">No se ha encontrado la ruta a la cual intenta acceder.</p>
          </div>
        </div>
      </div>
      <!-- error-403 end-->
    </div>
@stop