<div class="page-header">
    <div class="header-wrapper row m-0">
        <form class="form-inline search-full col" action="#" method="get">
            <div class="form-group w-100">
                <div class="Typeahead Typeahead--twitterUsers">
                    <div class="u-posRelative">
                        <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text"
                            placeholder="Busqueda rapida" name="q" title="" autofocus>
                        <div class="spinner-border Typeahead-spinner" role="status"><span
                                class="sr-only">Cargando...</span></div><i class="close-search"
                            data-feather="x"></i>
                    </div>
                    <div class="Typeahead-menu"></div>
                </div>
            </div>
        </form>
        <div class="header-logo-wrapper col-auto p-0">
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle"
                    data-feather="align-center"></i></div>
        </div>
        <div class="left-header col horizontal-wrapper ps-0">
            <ul class="horizontal-menu"></ul>
        </div>
        <div class="nav-right col-8 pull-right right-header p-0">
            <ul class="nav-menus">

                <script>
                    window.onload = function () {
                        renderizarSolicitudes()
                    }
                </script>

                <li class="onhover-dropdown">
                    <div class="notification-box"><i data-feather="bell"> </i><span
                            class="badge rounded-pill badge-secondary" id="span_cantidad">0</span></div>
                    <div class="onhover-show-div notification-dropdown">
                        <h6 class="f-18 mb-0 dropdown-title">Notificaciones</h6>
                
                        <ul id="ultimas_solicitudes"></ul>
                       
                    </div>
                </li>
                <li>
                    <div class="mode">
                      <span class="material-icons-outlined">dark_mode</span>
                    </div>
                </li>
                <li class="profile-nav onhover-dropdown p-0 me-0">
                    <div class="media profile-media"><img class="b-r-10"
                            src="{{ asset('images/profile.jpg') }}" alt="">
                        <div class="media-body"><span>Nombre del usuario</span>
                          <div style="display: flex; align-items: center;">
                            <span class="mb-0 font-roboto">Admin </span>
                            <span class="material-icons-outlined">expand_more</span>
                          </div>
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">
                        <li><a href="{{url('cambiar_contrasena')}}"><i data-feather="password"> </i><span>Cambiar contrasena</span></a></li>
                        <li><a href="{{url('logout')}}"><i data-feather="log-in"> </i><span>Cerrar sesión</span></a></li>
                       
                    </ul>
                 
                </li>
            </ul>
        </div>
    </div>
</div>