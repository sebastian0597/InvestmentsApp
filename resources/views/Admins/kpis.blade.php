@extends('Admins.layout')
@section('title', 'VIP WORLD TRADING')
@section('content')

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
 
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>

    <div class="page-wrapper compact-wrapper" id="pageWrapper">
    
        @include('Admins.componentes.barra_superior')
        
        <div class="page-body-wrapper">
           
            @include('Admins/componentes/barra_lateral')

            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-6">
                                <h3>KPI'S</h3>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                  @include(
                                    'Admins/componentes/enlance_navegacion'
                                )
    
                                    <li class="breadcrumb-item active">Kpis</li>
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
                                    <h5>KPI'S </h5>
                                </div>
                                <div class="card-body">
    
                                    <div class="mb-3 row g-3">
                                        <label class="col-sm-3 col-form-label text-sm-end">Fecha</label>
                                        <div class="col-xl-5 col-sm-9">
                                            <div class="input-group">
                                                <input class="datepicker-here form-control digits" type="text"
                                                    data-language="en">
    
                                                <button class="btn btn-secondary" id="Bookmark" onclick="generarInformeKPI()"
                                                    type="submit">Generar informe</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">Listado de clientes</h4>
                                        <div class="card-options"><a class="card-options-collapse" href="#"
                                                data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                                                class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                                class="fe fe-x"></i></a>
                                        </div>
                                    </div>
                                    <div class="table-responsive add-project">
                                        <table class="tablesorter" id="basic-6">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>N° identificación</th>
                                                    <th>Tipo de cliente</th>
                                                    <th>Inversion</th>
                                                    <th>Estado</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><a class="text-inherit" href="#">Sebastian correa delgado </a>
                                                    </td>
                                                    <td>1100970967</td>
                                                    <td><span class="status-icon bg-success"></span> Vip</td>
                                                    <td>$5.000.000,00</td>
                                                    <td>Activo</td> <!-- Inactivo-->
                                                    <td class="text-end">
                                                        <a class="icon" href="javascript:void(0)"></a>
                                                        <a class="btn btn-primary btn-sm" href="javascript:void(0)">
                                                            <i class="fa fa-pencil"></i> Generar Informe</a>
                                                        <a class="icon" href="javascript:void(0)"></a>
                                                    </td>
                                                </tr>
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
    </div>
@stop