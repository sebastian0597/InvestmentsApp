@can('admin.inicio','admin.inversiones.crear')
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

            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-6">
                                <h3>INVERSIONES</h3>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    @include('Admins/componentes/enlance_navegacion')
                                    <li class="breadcrumb-item active">Crear inversion</li>
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
                                    <h5>Formulario para crear inversión</h5>
                                </div>
                                <div class="card-body">
                                    
                                    <form class="needs-validation" novalidate="" accept-charset="UTF-8" enctype="multipart/form-data">
                                        
                                        <input type="hidden" id="id_cliente" value="{{$customer['id']}}">
                                        <input type="hidden" id="nombre_cliente" value="{{$customer['name']}} {{$customer['last_name']}}">
                                        <input type="hidden" id="email_cliente" value="{{$customer['email']}}">
                                        <h4>Datos del cliente</h4>

                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Nombres</label>
                                                <input class="form-control" value="{{$customer['name']}}" disabled>
                                                <span class="msg_error_form" id="error_nombres"></span>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Apellidos</label>
                                                <input class="form-control" value="{{$customer['last_name']}}"  disabled>
                                                <span class="msg_error_form" id="error_apellidos"></span>
                                            </div>
                                        </div>

                                        <div class="row g-3">

                                            <div class="col-md-4">
                                                <label class="form-label">Tipo de cliente</label>
                                                <input  class="form-control" value="{{$customer['customer_type']}}" disabled>
                                                <span class="msg_error_form" id="error_tipo_cliente"></span>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Número de documento</label>
                                                <input class="form-control" id="numero_documento" value="{{$customer['document_number']}}" disabled>
                                                <span class="msg_error_form" id="error_numero_documento"></span>
                                            </div>

                                        </div>
                                        <div class="row g-3">

                                            <div class="col-md-4">
                                                <label class="form-label">Correo electrónico</label>
                                                <input class="form-control" value="{{$customer['email']}}" disabled>
                                                <span class="msg_error_form" id="error_correo"></span>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Teléfono</label>
                                                <input class="form-control" value="{{$customer['phone']}}" disabled>
                                                <span class="msg_error_form" id="error_telefono"></span>
                                            </div>

                                        </div>
                                            <?php
                                                $cantidad_inversiones = count($customer['investments']);
                                                $fecha_inversion = count($customer['investments'])>0 ? $customer['investments'][$cantidad_inversiones-1]['investment_date'] : '----'; 
                                                $porcentaje = $cantidad_inversiones >0 ? $customer['investments'][$cantidad_inversiones-1]['percentage_investment']."%" : '--'; 
                                            ?>
                                        <div class="row g-3">
                                                                                     
                                            <div class="col-md-4">

                                                <label class="form-label">Valor total inversiones</label>
                                                <input class="form-control" value="${{$customer['total_investments_actives']}}" disabled>
                                                <span class="msg_error_form" id="error_telefono"></span>
                                            </div>

                                           
                                        </div>

                                        <div class="row g-3">

                                            <div class="col-md-4">
                                                <label class="form-label">Porcentaje rentabilidad mensuales</label>
                                                <input class="form-control" value="{{$porcentaje}}" disabled>
                                                <span class="msg_error_form" id="error_telefono"></span>
                                            </div>

                                            <div class="col-md-4">
                                              
                                                <?php $sum_rentabilidad=0; ?>
                                                @foreach ($customer['investments_active'] as  $key=>$item)
                                                    <?php 
                                                        if(!is_null($item['extract_detail'])){

                                                            foreach ($item['extract_detail'] as $key => $value) {
                                                                if(intval($value['investment_return'])>0){
                                                                    $sum_rentabilidad += intval($value['investment_return']);
                                                                }
                                                               
                                                            }
                                                        }

                                                    ?>
                                                @endforeach
                                                    
                                              
                                                <label class="form-label">Valor total de la rentabilidad</label>
                                                <input class="form-control" value="${{ number_format($sum_rentabilidad,0,'','.')}}" disabled>
                                                <span class="msg_error_form" id="error_telefono"></span>
                                            </div>


                                        </div>
                                        <br>
                                        <h4>Inversiones</h4>
                                        <div class="table-responsive"> 
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Id</th>
                                                    <th scope="col">Valor inicial</th>
                                                    <th scope="col">Valor actual</th>
                                                    <th scope="col">% rentabilidad</th>
                                                    <th scope="col">Rentabilidad mes</th>
                                                    <th scope="col">Fecha inversión</th>
                                                    <th scope="col">Fecha rentabilidad</th>
                                                    <th scope="col"></th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($customer['investments_active'] as  $key=>$item)
                                                        <tr>
                                                            <?php 
                                                                $porcentaje_rentabilidad=0;
                                                                $rentabilidad=0;

                                                                if(!is_null($item['extract_detail'])){

                                                                    foreach ($item['extract_detail'] as $key => $value) {

                                                                        $porcentaje_rentabilidad = $value['real_profitability_percentage']."%";
                                                                        
                                                                        if(intval($value['investment_return'])>0){
                                                                            $rentabilidad += intval($value['investment_return']);
                                                                        }
                                                                                                                                              
                                                                    }      
                                                                    
                                                                }

                                                                $porcentaje_rentabilidad_activo=0;
                                                                $rentabilidad_activa=0;
                                                                
                                                                if(!is_null($item['extract_detail_active'])){

                                                                    foreach ($item['extract_detail_active'] as $key => $value) {

                                                                        $porcentaje_rentabilidad_activo = $value['real_profitability_percentage'];
                                                                        $rentabilidad_activa += intval($value['investment_return']);
                                                                    
                                                                    }      

                                                                }
                                                             
                                                            ?>

                                                            <input type="hidden" id="id_inversion_{{$key}}" value="{{$item['id']}}">
                                                            <th scope="row">{{$item['id']}}</th>
                                                            <td>${{$item['initial_amount']}}</td>
                                                            <td>${{$item['amount']}}</td>
                                                            <td>{{$porcentaje_rentabilidad}}</td>
                                                            <td>${{number_format($rentabilidad_activa,0,'','.')}}</td>
                                                            <td>{{$item['investment_date']}}</td>
                                                            <td>{{$item['profitability_start_date']}}</td>
                                                            <td>
                                                                <?php if($rentabilidad_activa>0){ ?>
                                                                    <input type="hidden" id="valor_reinversion_{{$item['id']}}" value="{{ number_format($rentabilidad_activa,0,'','.')}}">
                                                                    <button onclick="crearReinversion({{$item['id']}})" id="btn_crear_reinversion_{{$item['id']}}}}" type="button" class="btn btn-primary btn-sm">Reinvertir</button>

                                                                <?php } ?>
                                                                
                                                            </td>
                                                        </tr>
                                                    @endforeach 
                                                 
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        <br>
                                        <h4>Inversión</h4>
                                        
                                        <div class="row g-3">
                                        
                                            <div class="col-md-3">
                                                <label>Tipo de inversión</label>
                                                
                                                <select onchange="seleccionarTipoInversion()" class="form-select" id="tipo_inversion" >
                                                    <option value="">Seleccione--</option>
                                                    @foreach ($investments_types as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="msg_error_form" id="error_tipo_inversion"></span>
                                                
                                            </div>
                                        </div>
                                        <br>
                                        <div style="display: none" id="div_reinversion">
                                            <div id="content_reinversion" class="row g-3">
                                                <div class="col-md-3" >
                                                    <label>Monto reinversión</label>
                                                    <input id="monto_reinversion" disabled class="form-control" type="text">
                                                    <span class="msg_error_form" id="error_monto_reinversion"></span>
                                                
                                                </div>

                                                <div class="col-md-3">
                                                    <label class="form-label">Valor invertido</label>
                                                    <input class="form-control" id="valor_invertido_reinversion" disabled>
                                                    <span class="msg_error_form" id="error_telefono"></span>
                                                </div>
                                              
                                                <div class="col-md-4">
                                                    <label class="form-label">Rentabilidad + Inversión</label>
                                                    <input class="form-control" id="valor_rentabilidad_reinversion" disabled>
                                                    <span class="msg_error_form" id="error_telefono"></span>
                                                </div>

                                            </div>
                                           
                                           
                                        </div>

                                        <div style="display: none" id="div_inversion" class="row g-3">
                                            <div class="col-md-3">
                                                <label class="form-label">Tipo de moneda</label>
                                                <select class="form-select" onchange="validarMontoMinimo();" id="tipo_moneda">
                                                    <option value="">Seleccione---</option>
                                                    @foreach ($currencies as $item)
                                                        <option value="{{ $item->code }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="msg_error_form" id="error_tipo_moneda"></span>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label">Método de pago</label>
                                                <select class="form-select" id="metodo_pago" >
                                                    @foreach ($payment_methods as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="msg_error_form" id="error_metodo_pago"></span>
                                            </div>

                                            <div class="col-md-3">
                                               
                                                <label>Monto de inversión</label>
                                                <input id="base_monto_inversion" onblur="validarMontoMinimo()" onkeyup="convertirAformatoMoneda(this)"  class="form-control" type="text">
                                                <span class="msg_error_form" id="error_base_monto_inversion"></span>
                                            
                                            </div>

                                            <div class="col-md-3">
                                                <label>Inversión en pesos</label>
                                                <input disabled id="monto_inversion" class="form-control" type="text">
                                                <span class="msg_error_form" id="error_monto_inversion"></span>
                                                
                                            </div>
                                        </div>

                                        <div style="display: none" class="row g-3" id="div_inversion_2">
                                      
                                            <div class="col-md-4">
                                                <label>Documento de consignación</label>
                                                <input class="form-control" id="archivo_consignacion" accept=".pdf, .png, .jpg, .jpeg" type="file">
                                                <span class="msg_error_form" id="error_archivo_consignacion"></span>
                                                
                                            </div>
                                        </div>
                                        @can('admin.inversiones.crear')
                                            <br><br>
                                            <div class="mb-4 placeholder-glow">

                                                <button class="btn btn-primary" id="btn_crear_inversion" type="button" onclick="crearInversion()">Crear inversión</button>
                                                
                                            </div>
                                        @endcan
                                        <br>
                                </div>
                              

                            </div>

                            <!-- <div class="mb-3">
                                <div class="form-check">
                                    <div class="checkbox p-0">
                                        <input class="form-check-input" id="invalidCheck" type="checkbox" >
                                        <label class="form-check-label" for="invalidCheck"></label>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div> -->
                           
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    </div>
    <!-- footer start-->
        @include('Admins.componentes.footer')
    </div>
</div>
 
@stop
@endcan
@cannot('admin.inicio')
    @include('errors.403')
@endcannot
