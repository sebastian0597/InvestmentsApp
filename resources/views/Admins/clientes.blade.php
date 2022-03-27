@extends('Admins.layout')
@section('title', 'VIP WORLD TRADING')
@section('content')
    <!-- loader starts-->
    <div class="loader-wrapper">
        <div class="loader-index"><span></span></div>
        <svg>
            <defs></defs>
            <filter id="goo">
                <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
                <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo">
                </fecolormatrix>
            </filter>
        </svg>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        @include('Admins.componentes.barra_superior')
        <!-- Page Header Ends                              -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            @include('Admins/componentes/barra_lateral')
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-6">
                                <h3>Clientes</h3>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>

                                    <li class="breadcrumb-item active">Clientes</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div style="display:flex; align-items:center;" class="card-header">
                                    <h5>CLIENTES VINCULADOS</h5>
                                    <a class="btn btn-primary float-right" href="{{url('crear_cliente')}}">Crear cliente</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="display" id="basic-6">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">NOMBRE</th>
                                                </tr>
                                                <tr>
                                                    <th>TIPO DE CLIENTE</th>
                                                    <th>TELÉFONO</th>
                                                    <th>UBICACIÓN</th>
                                                    <th>E-MAIL</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($customers as $item)
                                                <tr>
                                                    <td>
                                                        <div class="media"><img class="rounded-circle img-30 me-3"
                                                                src="{{ asset('images/profile.jpg') }}" alt="" />
                                                            <div class="media-body align-self-center">
                                                                <div>{{$item->name}} {{$item->last_name }}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>VIP</td>
                                                    <td>{{ $item->phone }}</td>
                                                    <td>{{$item->city }} - {{$item->country}}</td>
                                                    <td>sofiam@gmail.com</td>
                                                </tr>
                                                @endforeach
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
          
        </div>
    </div>
@stop
