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
          <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"></fecolormatrix>
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
                  <h3>Modulo de documentos</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    @include('Clientes/componentes/enlance_navegacion')
                    <li class="breadcrumb-item">Usuario</li>
                    <li class="breadcrumb-item active"> Documentos</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <?php 
            $contract_file =  'archivos/contratos/'.$customer['contract_file']; 
            $sarlaft_file =  'archivos/SARLAFT/'.$customer['sarlaft_file']; 

          ?>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="edit-profile">
              <div class="row">
                <div class="col-xl-6">
                  <div class="card">
              
                    <div class="card-body">
                      <b><h5>SARLAFT</h5></b>
                       <div class="mb-3">
                         @if (!empty($customer['sarlaft_file']) && !is_null($customer['sarlaft_file']))
                            <a target="_blank" class="btn btn-primary btn-sm" href="{{ asset($sarlaft_file) }}">
                              <i class="fa fa-download"></i> Descargar SARLAFT</a>
                         @endif
                        
                      </div>
                      <hr>
                      <div class="mb-3">
                            
                            <div class="col-sm-9">
                              <input class="form-control" id="documento_sarlaft" type="file">
                            </div>
                      </div>
                      <div class="mb-3">
                          <button class="btn btn-success btn-sm" onclick="cargarDocumentoSARLAFT();">
                                <i class="fa fa-save"></i>Cargar
                          </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-6">
                  <form class="card">
                   
                    <div class="card-body">
                      <b><h5>Contrato de inversión</h5></b>
                       <div class="mb-3">
                        @if (!empty($customer['contract_file']) && !is_null($customer['contract_file']))
                          <a target="_blank" class="btn btn-primary btn-sm" href="{{ asset($contract_file) }}">
                          <i class="fa fa-download"></i>Descargar contrato</a>
                        @endif
                        
                      </div>
                      <hr>
                      <div class="mb-3"> 
                          <div class="col-sm-9">
                            <input class="form-control" id="contrato_inversion" type="file">
                          </div>
                      </div>
                      <div class="mb-3">
                          <button type='button' class="btn btn-success btn-sm" onclick="cargarDocumentoContrato();">
                                <i class="fa fa-save"></i> Cargar
                          </button>
                      </div>
                    </div>
                    
                  </form>
                </div>
                
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->

        </div>
        <!-- footer start-->
      </div>
    </div>
@section('scripts')
    <script src="{{ asset('js/cliente/documentos.js') }}" defer></script>
@stop
@stop