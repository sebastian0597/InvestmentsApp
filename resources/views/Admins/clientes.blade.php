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
                                <h3>CLIENTES</h3>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    @include('Admins/componentes/enlance_navegacion')

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
                                <div style="display:flex; align-items:center; padding-right: 0px;" class="card-header">
                                    <div style="width:100%" class="row">
                                        <div class="col-6">
                                            <h5>Clientes vinculados</h5>
                                        </div>
                                        <div class="col-6">
                                            <ol style="float:right;" class="breadcrumb">
                                                <a class="btn btn-primary" href="{{ url('crear_cliente') }}">Crear
                                                    cliente</a>
                                            </ol>
                                        </div>
                                    </div>
                                  
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
                                                <?php $i=0; ?>
                                                @if (count($customers)>0)
                                                    
                                                    @foreach ($customers as $item)
                                                        <tr>
                                                            <td>
                                                                <div class="media"><img
                                                                        class="rounded-circle img-30 me-3"
                                                                        src="{{ asset('images/profile.jpg') }}" alt="" />
                                                                    <div class="media-body align-self-center">
                                                                        <div>{{ $item[$i]['name'] }}
                                                                            {{ $item[$i]['last_name'] }}</div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>{{ $item[$i]['customer_type'] }}</td>
                                                            <td>{{ $item[$i]['phone'] }}</td>
                                                            <td>{{ $item[$i]['city'] }} - {{ $item[$i]['country'] }}</td>
                                                            <td>{{ $item[$i]['email'] }}</td>
                                                        </tr>
                                                        <?php $i++; ?>
                                                    @endforeach
                                                @endif
                                                    


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
