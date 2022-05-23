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
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
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
                                <h3>Módulo de desembolsos</h3>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">
                                            <i data-feather="home"></i></a></li>
                                    <li class="breadcrumb-item">Usuario</li>
                                    <li class="breadcrumb-item active"> Desembolos</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="edit-profile">
                        <div class="row">

                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">Listado de desembolsos</h4>
                                        <div class="card-options"><a class="card-options-collapse" href="#"
                                                data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                                                class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                                    class="fe fe-x"></i></a></div>
                                    </div>
                                    <div class="table-responsive add-project">
                                        <table class="table card-table table-vcenter text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Tipo cliente</th>
                                                    <th>Fecha desembolso</th>
                                                    <th>Valor desembolso</th>
                                                    <th>Tipo desembolso</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($disbursetments as $item)
                                                <tr>
                                                    <td><a class="text-inherit">{{$item['customer']['customer_type']}}</a></td>
                                                    <td>{{$item['date_disbursement']}}</td>
                                                    <td><span class="status-icon bg-success"></span>${{$item['value_consign']}}</td>
                                                    <td>{{$item['disbursement_type']}}</td>
                                                    <td class="text-end">

                                                    </td>
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
