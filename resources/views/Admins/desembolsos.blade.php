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
                                <h3>DESEMBOLSOS</h3>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    @include(
                                        'Admins/componentes/enlance_navegacion'
                                    )

                                    <li class="breadcrumb-item active">Módulo de desembolsos</li>
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
                                            <h5>Gestionar desembolso</h5>
                                        </div>
                                        <div class="col-6">
                                            <ol style="float:right;" class="breadcrumb">
                                                @include(
                                                        'Admins/componentes/modal_busqueda_desembolsos'
                                                    ) 
                                            </ol>
                                        </div>
                                    </div> 
                                </div>
                                <div class="card-body">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input class="form-control" id="param_desembolso_tabla" type="text"
                                                placeholder="Nombre o número identificación">
                    
                                            <button class="btn btn-secondary" id="btn_buscar_cliente"
                                                onclick="buscarClienteDesembolsoTabla()" type="submit">Buscar</button>
                                        </div>
                                    </div>
                                   
                                    <br><br>
                                    <div id="content_clientes_tabla"></div>

                                    <div class="col-12">
                     
                                        <h5>Tipo de desembolso:</h5>
                                        <div>

                                            <div class="row g-3">

                                                <div class="col-md-4">

                                                    <select onchange="seleccionarTipoDesembolso()"
                                                        class="form-select" id="tipo_desembolso">

                                                        <option value="" selected="">--- Seleccione ---</option>
                                                        @foreach ($disbursement_types as $item)
                                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach


                                                    </select>
                                                    <span class="msg_error_form" id="error_tipo_desembolso"></span>
                                                </div>
                                                <!-- Rentabilidad Mensual -->
                                                <div style="display: none;" id="div_mensual" class="row g-3">

                                                    
                                                    <div class="col-md-4">
                                                        <label class="form-label">Tipo de cliente:</label>
                                                        <select onchange="seleccionarTipoClienteDesembolsos()" class="form-select"
                                                            id="tipo_cliente">
                                                            <option value="" selected="">Seleccione ---</option>
                                                            @foreach ($customer_types as $item)
                                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endforeach


                                                        </select>
                                                    </div>

                                                </div>
                                                <div id="div_mensual_desembolso"  class="row g-3"></div>

                                                <div  id="div_parcial" class="mb-1 row g-1"></div>

                                                <div  id="div_total" class="mb-1 row g-1"></div>

                                                <div id="container_datos_cliente"></div>

                                                <!-- CAMPOS CUANDO TIENE OTRA ACTIVIDAD -->

                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">

                                        <div class="card-options"><a class="card-options-collapse" href="#"
                                                data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                                                class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                                    class="fe fe-x"></i></a></div>

                                        <div class="table-responsive add-project">

                                            <h4 class="card-title mb-0">Histórico de desembolsos:</h4><br><br>
                                            
                                            <div class="input-group">

                                                <input id="fecha_busqueda" type="month" />

                                                <button class="btn btn-secondary" id="btn_historico_desembolsos" onclick="consultarHistoricoDesembolsos()"
                                                    type="button">Buscar</button>

                                            </div>
                                            <br><br>
                                            <div id="tabla_historico_desembolsos">

                                            </div>
                                            <br><br>
                                            <div class="col-md-6">
                                                <button class="btn btn-outline-success btn-lg" id="Bookmark"
                                                    onclick="mostrarArchivos()" type="submit">Mostrar archivos</button>

                                            </div>
                                            <div id="container_archivos"  class="col-md-12"></div>

                                        </div>
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
