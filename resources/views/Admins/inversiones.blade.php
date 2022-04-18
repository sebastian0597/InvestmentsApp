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
                                    <!--<div class="card-header">
                                        <h4>Módulo de Inversiones </h4>
                                        <br>
                                        <div class="box">
                                            <div class="container-1">
                                                <span class="icon"><i class="fa fa-search"></i></span>
                                                <input class="form-control" type="search" id="search" placeholder="Busqueda..." />
                                            </div>
                                        </div>

                                        <a class="btn btn-primary btn-sm" href="javascript:void(0)">
                                            <i class="fa fa-pencil"></i>Exportar informe total</a>
                                    </div>-->
                                    <div style="display:flex; align-items:center; padding-right: 0px;" class="card-header">
                                        <div style="width:100%" class="row">
                                            <div class="col-6">
                                                <h5>Clientes vinculados</h5>
                                            </div>
                                            <div class="col-6">
                                            
                                                <ol style="float:right;" class="breadcrumb">
                                                    <!--<b style="float: right">Total clientes: {{count($customers)}}</b> -->
                                                    
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalInversiones">
                                                   Editar inversión
                                                    </button>
                                                    <div class="modal fade" id="modalInversiones" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Búsqueda de inversiones.</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="needs-validation" novalidate="" accept-charset="UTF-8" enctype="multipart/form-data">
                                                                    <div class="mb-3">
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" class="form-control"
                                                                            placeholder="N° de documento del cliente o de contrato"
                                                                                id="busqueda_inversiones">
                                                                            <button onclick="buscarInversionesPorParametros()"
                                                                                style="display: flex; align-items: center"
                                                                                class="btn btn-outline-primary" type="button"><span
                                                                                    class="material-icons-outlined">
                                                                                    search
                                                                                </span>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                <div id="investments_container">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </ol>

                                            </div>
                                        </div> 
                                    </div>

                                    <div class="card-body">

                                        <div class="col-md-12">
                                            <div class="card">
                                                                                            
                                                <div class="table-responsive add-project">
                                                    <table class="display tablesorter" id="basic-6">
                                                        <thead>
                                                            <tr>
                                                                <th>Nombre</th>
                                                                <th>N° Documento</th>
                                                                <th>Tipo cliente</th>
                                                                <th>Telefono</th>
                                                                <th>Correo</th>
                                                                <th>Inversion</th>
                                                                <!--<th></th>-->
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($customers as $item)
                                                          
                                                                <tr>
                                                                    <td><a class="text-inherit" href="{{url('crear_inversion/'.$item['id'])}}">{{$item["name"]}} {{$item["last_name"]}}</a></td>
                                                                    <td>{{$item["document_number"]}}</td>
                                                                    <td><span class="status-icon bg-success"></span>{{$item["customer_type"]}}</td>
                                                                    <td>{{$item["phone"]}}</td>
                                                                    <td>{{$item["email"]}}</td>
                                                                    <td>{{'$'.$item['total_investments']}}</td>
                                                                    <!--<td class="text-end">
                                                                    
                                                                        <a class="btn btn-success btn-sm"
                                                                            href="javascript:void(0)">
                                                                            Exportar</a>

                                                                        <a class="btn btn-primary btn-sm"
                                                                            href="javascript:void(0)">
                                                                            Editar</a>
                                                                    </td> -->
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
