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
          <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
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
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="edit-profile">
              <div class="row">
                <div class="col-xl-6">
                  <div class="card">
                   <!--   <div class="card-header">
                      <h4 class="card-title mb-0">Mi perfil</h4>
                      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                    </div> -->
                    <div class="card-body">
                      <b><h5>SARLAFT</h5></b>
                       <div class="mb-3">
                         <a class="btn btn-primary btn-sm" href="javascript:void(0)">
                                <i class="fa fa-download"></i> Descargar SARLAFT</a>
                      </div>
                      <hr>
                      <div class="mb-3">
                            
                            <div class="col-sm-9">
                              <input class="form-control" type="file">
                            </div>
                      </div>
                      <div class="mb-3">
                         <a class="btn btn-success btn-lg" href="javascript:void(0)">
                                <i class="fa fa-save"></i> GUARDAR</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-6">
                  <form class="card">
                    
                    <div class="card-body">
                      <b><h5>SARLAFT</h5></b>
                       <div class="mb-3">
                         <a class="btn btn-primary btn" href="javascript:void(0)">
                                <i class="fa fa-download"></i> Descargar SARLAFT</a>
                      </div>
                      <hr>
                      <div class="mb-3">
                            
                            <div class="col-sm-9">
                              <input class="form-control" type="file">
                            </div>
                      </div>
                      <div class="mb-3">
                         <a class="btn btn-success btn" href="javascript:void(0)">
                                <i class="fa fa-save"></i> GUARDAR</a>
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
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12 footer-copyright text-center">
                <p class="mb-0">Copyright 2022 © </p>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
@stop