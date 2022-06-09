@can(['admin.inicio','admin.kpis.index'])
@extends('layout')
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
 
    <div class="tap-top"></div>

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
                                        <label class="col-sm-3 col-form-label text-sm-end"><b>Fecha</b></label>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <input id="fecha_busqueda" type="month" />
                                                <button class="btn btn-secondary" id="btn_generar_kpi" onclick="generarKPI()" type="button">Generar informe</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div id='kpi_clientes_activos' class="col-md-12">
                                    
                                </div>
                                <div id='kpi_clientes_inactivos' class="col-md-12">
                                    
                                </div> 
                                <div id='kpi_btn_exportar' class="col-md-12">
                                    
                                </div> 
                            </div>
                        </div>                                    
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@endcan