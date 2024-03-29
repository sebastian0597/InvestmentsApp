@can('cliente.inicio')
<div class="header-wrapper row m-0">
    <form class="form-inline search-full col" action="#" method="get">
      <div class="form-group w-100">
        <div class="Typeahead Typeahead--twitterUsers">
          <div class="u-posRelative">
            <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Busqueda rapida" name="q" title="" autofocus>
            <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Cargando...</span></div><i class="close-search" data-feather="x"></i>
          </div>
          <div class="Typeahead-menu"></div>
        </div>
      </div>
    </form>
    <div class="header-logo-wrapper col-auto p-0">
      <!--<div class="logo-wrapper"><a href="index.html"><img class="img-fluid" src="../assets/images/logo/logo.png" alt=""></a></div>-->
      <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
    </div>
    <div class="left-header col horizontal-wrapper ps-0">
      <ul class="horizontal-menu">
        
        <script>
          window.onload = function () {
              validarInicioSesionPrimeraVezCliente()
          }

      </script>
        
      </ul>
    </div>
    <div class="nav-right col-8 pull-right right-header p-0">
      <ul class="nav-menus">
        
     
        <!--<li class="onhover-dropdown">
          <div class="notification-box"><i data-feather="bell"> </i><span class="badge rounded-pill badge-secondary">4 </span></div>
          <div class="onhover-show-div notification-dropdown">
            <h6 class="f-18 mb-0 dropdown-title">Notificaciones                             </h6>
            <ul>
              <li class="b-l-primary border-4">
                <p> <span class="font-danger"></span></p>
              </li>
              <li class="b-l-success border-4">
                <p><span class="font-success"></span></p>
              </li>
              <li class="b-l-info border-4">
                <p><span class="font-info"></span></p>
              </li>
              <li class="b-l-warning border-4">
                <p><span class="font-warning"></span></p>
              </li>
              <li><a class="f-w-700" href="#">Ver todas las notificaciones
              </a></li>
            </ul>
          </div>
        </li>-->
        
        <li>
          <div class="mode">
            <span class="material-icons-outlined">dark_mode</span>
          </div>
        </li>
         
        <li class="profile-nav onhover-dropdown p-0 me-0">
          <?php 
        
          $image_profile = !is_null($customer['photo']) ? 'archivos/fotos/'.$customer['photo'] : 'images/profile.jpg';
      
          ?>
          <div class="media profile-media"><img width='54px' heigth='54px' class="b-r-10" src="{{  asset($image_profile) }}" alt="">
            <div class="media-body"><span>{{auth()->user()->name}}</span>
              <input type="hidden" id="ind_inicio_sesion" value="{{auth()->user()->ind_first_login}}">
              <input type="hidden" id="user_id" value="{{auth()->user()->id}}">
              <p class="mb-0 font-roboto">Cliente<i class="middle fa fa-angle-down"></i></p>

            </div>
          </div>
          <ul class="profile-dropdown onhover-show-div">
            <li><a href="{{url('cliente/cambiar_contrasena')}}"><i class="fa fa-key"></i><span>&nbsp;&nbsp;Cambiar contraseña</span></a></li>
            <li><a href="{{url('logout')}}"><i data-feather="log-in"> </i><span>Cerrar sesión</span></a></li>
          </ul>
        </li>
      </ul>
    </div>
  
  </div>
@endcan