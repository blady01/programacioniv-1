<?php
  include_once(dirname(__FILE__)."/config.php");
?>

<!---    <link rel="stylesheet" href="css/menu.css">

--------------------------- NAVIGATION BAR (MENU)-------------------------------------->
<link rel="stylesheet" href="css/menu.css">
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
  
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
    <header>
      <nav class="navbar navbar-inverse" >
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand usu-empleo" href="<?php echo RUTA;?>/index.php"><span class="glyphicon glyphicon-briefcase"></span> Usu Empleo</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">     
            <ul class="nav navbar-nav navbar-right">
            
            <!-----------------TODOS (PUBLICO Y PRIVADO)------------------>
            <li><a href='<?php echo RUTA;?>/ver_puestos.php'>Ver Puestos</a></li>
            <li><a href='<?php echo RUTA;?>/ver_empresas.php'>Ver Empresas</a></li>


            <!-----------------LOGUEADO COMO USUARIO------------------>
            <?php
            if(isset($_SESSION['id_usuario']) && empty($_SESSION['empresaLogeada'])) {
              ?>
              <li><a href='<?php echo RUTA;?>/oferente/perfil.php'>Perfil</a></li>
              <li><a href='<?php echo RUTA;?>/oferente/trabajos_aplicados.php'>Mis Trabajos Aplicados</a></li>
              <li onclick="cerrarSesion()"><a><span class="glyphicon glyphicon-log-out"></span> Cerrar sesión</a></li>
            
            <!-----------------LOGUEADO COMO EMPRESA------------------>
            <?php
            } else if(isset($_SESSION['id_usuario']) && isset($_SESSION['empresaLogeada'])) {
            ?>
            <li><a href='<?php echo RUTA;?>/empresa/buscar_oferente.php'>Buscar Oferentes</a></li>
            <li><a href='<?php echo RUTA;?>/empresa/crear_puestoTrabajo.php'>Agregar Puestos</a></li>
            <li><a href='<?php echo RUTA;?>/empresa/trabajos_publicados.php'>Puestos Publicados</a></li>
            <li onclick="cerrarSesion()"><a><span class="glyphicon glyphicon-log-out"></span> Cerrar sesión</a></li>

            <!----------------- SOLO PARTE PUBLICA(no privada)------------------>
            <?php } else { ?>
              <li><a href='<?php echo RUTA;?>/empresa.php'><span class="glyphicon glyphicon-home"></span> Empresa</a></li>
              <li><a href='<?php echo RUTA;?>/oferente.php'><span class="glyphicon glyphicon-user"></span> Oferente</a></li>
              <li><a href='<?php echo RUTA;?>/login.php'><span class="glyphicon glyphicon-log-in"></span> Inicio de sesión</a></li>
              <li><a href='<?php echo RUTA;?>/index.php#ancla'><span class="glyphicon glyphicon-info-sign"></span> Acerca de</a></li>
            <?php } ?>              
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </header>


    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
      function cerrarSesion(){

        console.log(window.location.pathname)
        if (window.location.pathname =='/programacioniv/oferente/perfil.php' || window.location.pathname =='/programacioniv/oferente/trabajos_aplicados.php' || window.location.pathname =='/programacioniv/empresa/buscar_oferente.php' || window.location.pathname =='/programacioniv/empresa/editar_puestoTrabajo.php' || window.location.pathname =='/programacioniv/empresa/trabajos_publicados.php' )
        {
          alertify.confirm('Alerta', '¿Está seguro de cerrar esta sesión?', function () {
          window.location = '../cerrar_sesion.php'
         }, function () {
        alertify.error('Cancelado');
          });
        }

         else if (window.location.pathname =='/programacioniv/ver_puestos.php' || window.location.pathname =='/programacioniv/ver_empresas.php' )
        {
          alertify.confirm('Alerta', '¿Está seguro de cerrar esta sesión?', function () {
          window.location = 'cerrar_sesion.php'
         }, function () {
        alertify.error('Cancelado');
          });
        }

    /*  alertify.confirm('Alerta', '¿Está seguro de cerrar esta sesión?', function () {
          window.location = 'cerrar_sesion.php'
         }, function () {
        alertify.error('Cancelado');
        
    }); */
    
    }

    </script>
<!------------------------------------------------------- FIN DE MENU -------------------------------------------->

