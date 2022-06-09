@can('cliente.inicio')
@extends('layout')
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
    <div class="tap-top"></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <div class="page-header">
            @include('Clientes/componentes/barra_superior')
        </div>
        <!-- Page Header Ends                              -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            @include('Clientes/componentes/barra_lateral')

            <!-- Page Sidebar Ends-->
            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-6">
                                <h3>Módulo de extractos</h3>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    @include(
                                        'Clientes/componentes/enlance_navegacion'
                                    )
                                    <li class="breadcrumb-item">Usuario</li>
                                    <li class="breadcrumb-item active"> Extractos</li>
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

                                <div class="card-body">

                                    <div class="mb-12 row g-12">
                                        <label class="col-sm-3 col-form-label text-sm-end">Búsqueda</label>
                                        <div class="col-xl-5 col-sm-9">
                                            <div class="input-group">

                                                <input id="fecha_busqueda" type="month" />
                                                <button class="btn btn-secondary" id="btn_extractos"
                                                    onclick="buscarExtractosPorfecha()" type="button"><i
                                                        class="fa fa-download"></i> Generar</button>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    <br><br>
                                    <div id="extractos_container" class="mb-12 row g-12"></div>

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
    @section('scripts')
        <script src="{{ asset('js/cliente/extractos.js') }}" defer></script>
    @stop
@stop
@endcan
