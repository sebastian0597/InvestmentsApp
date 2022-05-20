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
                                <h3>EXTRACTOS</h3>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    @include(
                                        'Admins/componentes/enlance_navegacion'
                                    )
                                    <li class="breadcrumb-item active">Extractos</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
              
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Extractos mensuales</h5><span></span>
                                </div>

                                <div class="card-body">

                                    <div class="col-md-6 mb-3">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control"
                                                placeholder="Nombre o número de documento del cliente"
                                                id="busqueda_cliente_extractos">
                                            <button onclick="buscarClientePorParametros()"
                                                style="display: flex; align-items: center"
                                                class="btn btn-outline-primary" type="button"><span
                                                    class="material-icons-outlined">
                                                    search
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                   
                                    <div class="col-lg-12 col-md-12">
                                        <h2 class="ng-binding">Extractos</h2>
                                        <p class="doc-intro ng-binding"> </p>
                                        <div id="content-clientes"></div>
                                    </div>
                                    <br><br>
                                    <div class='row'>
                                        <h4 class="ng-binding">Porcentaje de rentabilidad</h4>
                                        <div class='col-md-4'>
                                            <label class="form-label">Tipo de cliente</label>
                                            <select onchange="seleccionarTipoCliente()" class="form-select" id="tipo_cliente">
                                                <option value="" selected>Seleccione---</option>
                                                @foreach ($customer_types as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div style="display: none" id="div_porcentaje" class='col-md-3'>
                                            <label class="form-label">Porcentaje</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="porcentaje">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div id="div_cliente_premium" style="display: none">
                                           
                                                <label>Documento del cliente</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control"
                                                        placeholder="Número de documento del cliente premium"
                                                        id="busqueda_cliente_premium_extractos">
                                                    <button onclick="buscarClientePremiumPorDocumento()"
                                                        style="display: flex; align-items: center"
                                                        class="btn btn-outline-primary" type="button"><span
                                                            class="material-icons-outlined">
                                                            search
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div id="div_premium_form"></div>
                                    <br>
                                    <div class="row">
                                        <div class='col-sm placeholder-glow'>
                                            <button type="button" id="btn_guardar_porcentaje" style="display:none" onclick="guardarPorcentajeRentabilidad()" class="btn btn-primary">Guardar % rentabilidad</button>
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
