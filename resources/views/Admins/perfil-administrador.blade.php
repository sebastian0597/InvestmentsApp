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
        @include('Admins.componentes.barra_superior')
      </div>
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        @include('Admins/componentes/barra_lateral')

        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h3>Perfil de administrador</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">                                       <i data-feather="home"></i></a></li>
                    
                    <li class="breadcrumb-item active"> perfil de administrador</li>
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
                    <h5>Creación de perfil de administración </h5>
                  </div>
               <div class="card-body">
                    <form class="needs-validation" novalidate="">
                       <!-- nombre-->
                        <h5>Datos de inicio</h5>

                      <div class="row g-3">
                        <div class="col-md-4">
                          <label class="form-label" for="validationCustom01">Primer nombre</label>
                          <input class="form-control" id="validationCustom01" type="text" value="" required="">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label" for="validationCustom02">Segundo nombre</label>
                          <input class="form-control" id="validationCustom02" type="text" value="" required="">
                        </div>
                      </div>

                         <!-- apellido-->
                      <div class="row g-3">
                        <div class="col-md-4">
                          <label class="form-label" for="validationCustom01">Correo</label>
                          <input class="form-control" id="validationCustom01" type="text" value="" required="">
                        </div>
                        <div class="col-md-3">
                          <label class="form-label" for="validationCustom04">Asignación de Rol</label>
                          <select class="form-select" id="validationCustom04" required="">
                            <option >Tipo 1</option>
                            <option >Tipo 2</option>
                            <option> Tipo 3</option>
                          </select>
                        </div>
                      </div>





                      </div>

                      </div>




                   
                      <button class="btn btn-primary" type="submit">Crear administrador</button>
                      <br><br><br>
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
       
      </div>
    </div>
  
</html>
@stop