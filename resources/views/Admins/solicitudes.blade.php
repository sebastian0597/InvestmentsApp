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
                                <h3>SOLICITUDES</h3>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    @include(
                                        'Admins/componentes/enlance_navegacion'
                                    )

                                    <li class="breadcrumb-item active">Módulo de solicitudes:</li>
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
                                <div class="card-header">
                                    <h4>Solicitudes de usuarios y novedades </h4>
                                </div>
                                <div class="card-body">

                                    <div class="col-xl-12 notification box-col-12">
                                        <div class="card">
                                            <div class="card-header card-no-border">
                                                <div class="header-top">
                                                    <h5 class="m-0">Lista de solicitudes de clientes</h5>

                                                </div>
                                            </div>
                                            <div class="card-body pt-0">
                                                @foreach ($request as $item)
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <input type="hidden" type="hdd_id_request"
                                                                value="{{ $item['id'] }}">
                                                            <p>{{ $item['date'] }} <span>{{ $item['hour'] }}</span><span
                                                                    class="badge badge-secondary">{{ $item['status'] }}</span>
                                                            </p>
                                                            <h6>{{ $item['request_type'] }}</h6>
                                                            <span>{{ $item['description'] }}</span>

                                                        </div>
                                                        <button class="btn btn-primary" type="submit">Responder</button>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
        </div>

    </div>
    </div>
@stop
