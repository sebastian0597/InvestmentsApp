@can(['admin.inicio','admin.inversiones.index'])
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
                                                    @can('admin.inversiones.editar')
                                                        @include(
                                                            'Admins/componentes/modal_busqueda_inversiones'
                                                        ) 
                                                    @endcan  
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
                                                                    <td><a class="text-inherit" href="{{url('crear_inversion/'.$item['id'])}}">{{$item["document_number"]}}</a></td>
                                                                    <td><a class="text-inherit" href="{{url('crear_inversion/'.$item['id'])}}">{{$item["customer_type"]}}</a></td>
                                                                    <td><a class="text-inherit" href="{{url('crear_inversion/'.$item['id'])}}">{{$item["phone"]}}</a></td>
                                                                    <td><a class="text-inherit" href="{{url('crear_inversion/'.$item['id'])}}">{{$item["email"]}}</a></td>
                                                                    <td><a class="text-inherit" href="{{url('crear_inversion/'.$item['id'])}}">{{'$'.$item['total_investments']}}</a></td>
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
@endcan