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
                                    <h3>INVERSIONES</h3>
                                </div>
                                <div class="col-6">
                                    <ol class="breadcrumb">
                                        @include(
                                            'Admins/componentes/enlance_navegacion'
                                        )

                                        <li class="breadcrumb-item active"> Módulo de inversiones</li>
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
                                        <h5>Módulo de Inversiones </h5>
                                        <br>
                                        <div class="box">
                                            <div class="container-1">
                                                <span class="icon"><i class="fa fa-search"></i></span>
                                                <input type="search" id="search" placeholder="Busqueda..." />
                                            </div>
                                        </div>

                                        <a class="btn btn-primary btn-sm" href="javascript:void(0)">
                                            <i class="fa fa-pencil"></i>Exportar informe total</a>
                                    </div>

                                    <div class="card-body">

                                        <div class="col-md-12">
                                            <div class="card">
                                                <div style="display:flex; align-items:center; padding-right: 0px; width:100%" class="card-header">
                                                    <h4 class="card-title mb-0">Listado de clientes</h4>
                                                    <!--<div class="card-options"><a class="card-options-collapse" href="#"
                                                            data-bs-toggle="card-collapse"><i
                                                                class="fe fe-chevron-up"></i></a><a
                                                            class="card-options-remove" href="#"
                                                            data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
                                                    </div>-->
                                                    <b style="float: right">Total clientes: {{count($customers)}}</b>

                                                </div>
                                                
                                                <!--<div style="display:flex; align-items:center; padding-right: 0px;" class="card-header">
                                                    <div style="width:100%" class="row">
                                                        <div class="col-6">
                                                            <h4 class="card-title mb-0">Listado de clientes</h4>
                                                        </div>
                                                        <div class="col-6">
                                                            <ol style="float:right;" class="breadcrumb">
                                                                <a class="btn btn-primary" href="{{ url('crear_cliente') }}">Crear
                                                                    cliente</a>
                                                            </ol>
                                                        </div>
                                                    </div> 
                                                </div> -->  
                                                
                                                <div class="table-responsive add-project">
                                                    <table class="display tablesorter" id="basic-6">
                                                        <thead>
                                                            <tr>
                                                                <th>Nombre</th>
                                                                <th>Numero de identificación</th>
                                                                <th>Tipo de cliente</th>
                                                                <th>Telefono</th>
                                                                <th>Correo</th>
                                                                <th>Inversion</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($customers as $item)
                                                           
                                                                <tr>
                                                                    <td><a class="text-inherit" href="#">{{$item["name"]}} {{$item["last_name"]}}</a></td>
                                                                    <td>{{$item["document_number"]}}</td>
                                                                    <td><span class="status-icon bg-success"></span>{{$item["customer_type"]}}</td>
                                                                    <td>{{$item["phone"]}}</td>
                                                                    <td>{{$item["email"]}}</td>
                                                                    <td>{{'$'.$item['total_investments']}}</td>
                                                                    <td class="text-end">
                                                                    
                                                                        <a class="btn btn-success btn-sm"
                                                                            href="javascript:void(0)">
                                                                            Exportar</a>

                                                                        <a class="btn btn-primary btn-sm"
                                                                            href="javascript:void(0)">
                                                                            Editar</a>
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
                        </div>
                    </div>
                    <!-- Container-fluid Ends-->
                </div>
                <!-- footer start-->

            </div>
        </div>
    @stop
