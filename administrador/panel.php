<?php

//Para manejar las variables de sesión en esta página
session_start();

// Si el usuario no ha iniciado sesión, redirija a la página de inicio.
// Esto es obligatorio si el usuario intenta ingresar dashboard.php manualmente en la URL.
if(empty($_SESSION['idAdministrador'])) {
  header("Location: ../login.php");
  exit();
}

// Inclusión de conexión de base de datos desde el archivo conexion.php para evitar la reescritura en todos los archivos
  
  require_once("../conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Panel</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  </head>
  <body>
    
    <!-- NAVIGATION BAR -->
    <header>
      <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="panel.php"><span class="glyphicon glyphicon-briefcase"></span> Usu Empleo</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">     
            <ul class="nav navbar-nav navbar-right">
              <li><a href="../cerrar_sesion.php"><span class="glyphicon glyphicon-log-in"></span> Cerrar sesión</a></li>

            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </header>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          <div class="list-group">
            <a href="panel.php" class="list-group-item active">Panel</a>
            <a href="oferente.php" class="list-group-item">Oferentes</a>
            <a href="empresa.php" class="list-group-item">Empresas</a>
            <a href="puesto.php" class="list-group-item">Puestos de Trabajo</a>
            <a href="caracteristicas.php" class="list-group-item">Caracteristicas</a>
            <a href="chat.php" class="list-group-item">Chat</a>
          </div>
        </div>
        <div class="col-md-8">
       <div class="container-fluid">
  <h2>Solicitudes Pendientes</h2>
  
  <ul class="nav nav-pills">
    <li class="active"><a data-toggle="pill" href="#empresas">Empresas</a></li>
    <li><a data-toggle="pill" href="#oferentes">Oferentes</a></li>
    
  </ul>
  
  <div class="tab-content">
    <div id="empresas" class="tab-pane fade in active">
      <h3>Empresas</h3>
      <div class="col-md-8">
        <?php  
          $sql = "SELECT * FROM empresas WHERE aprobado='2'";
          $result= $conn -> query($sql);
          if($result ->num_rows > 0){
          echo '<h4>Total de empresas pendientes: ' . $result->num_rows  .'</h4>';
        }
        ?>
          <table class="table">
            <thead>
              <th>No</th>
              <th>Nombre empresa</th>
              <th>Descripcion</th>
              <th>Correo</th>
              <th>Telefono</th>
              <th>Accion</th>
            </thead>
            <tbody>
              <?php
                $sql = "SELECT * FROM empresas WHERE aprobado='2'";
                $result = $conn->query($sql);
                if($result->num_rows > 0) {
                  $i = 0;
                  while($row = $result->fetch_assoc()) {
                    ?>
                      <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo $row['descripcion']; ?></td>
                        <td><?php echo $row['correo']; ?></td>
                        <td><?php echo $row['telefono']; ?></td>
                        <td><a href="rechazar_empresa.php?id=<?php echo $row['idEmpresa']; ?>">Rechazar</a></td>
                        <td name="btnAprobar" data-email=<?php echo $row['correo']; ?> data-pass=<?php echo $row['clave']; ?> data-tipo="empresa" data-id=<?php echo $row['idEmpresa']; ?>><a href="#" >Aprobar</a></td>
                      </tr>
                    <?php
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
    </div>
    <div id="oferentes" class="tab-pane fade">
      <h3>Oferentes</h3>
      <div class="col-md-8">
        <?php  
          $sql = "SELECT * FROM oferentes WHERE aprobado='2'";
          $result= $conn -> query($sql);
          if($result ->num_rows > 0){
          echo '<h4>Total de oferentes pendientes: '.$result->num_rows  .'</h4>';
        }
        ?>
          <table class="table">
            <thead>
              <th>No</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Correo</th>
              <th>nacionalidad</th>
              <th>Telefono</th>
              <th>Residencia</th>
              <th>Accion</th>
            </thead>
            <tbody>
              <?php
                $sql = "SELECT * FROM oferentes WHERE aprobado='2'" ;
                $result= $conn -> query($sql);
                if($result ->num_rows > 0){
                  $i = 0;
                  while($row = $result ->fetch_assoc()) {
                    ?>
                      <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo $row['apellido']; ?></td>
                        <td><?php echo $row['correo']; ?></td>
                        <td><?php echo $row['nacionalidad']; ?></td>
                        <td><?php echo $row['telefono']; ?></td>
                        <td><?php echo $row['residencia']; ?></td>
                        <td><a href="rechazar_oferente.php?id=<?php echo $row['idOferente']; ?>">Rechazar</a></td>
                        <td name="btnAprobar" data-email=<?php echo $row['correo']; ?> data-pass=<?php echo $row['clave']; ?> data-tipo="oferente" data-id=<?php echo $row['idOferente']; ?>><a href="#" >Aprobar</a></td>
                      </tr>
                    <?php
                  }
                }
              ?>
              
            </tbody>
          </table>
        </div>
    </div>
  </div>
</div>
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- The core Firebase JS SDK is always required and must be listed first -->
   <script src="https://www.gstatic.com/firebasejs/6.2.0/firebase-app.js"></script>

    <!-- config firebase -->
    <script src="../js/configFirebase.js"></script>

    <script src="https://www.gstatic.com/firebasejs/6.2.0/firebase-auth.js"></script>

    <script>

      document.addEventListener("DOMContentLoaded", e=>{
        createUserFirebase()
      });
      function createUserFirebase(){
        let listAprobar=document.getElementsByName('btnAprobar');
        listAprobar.forEach(element => {
        element.addEventListener('click', e => {
            //console.log(element);
            let email=element.dataset.email
            let pass=element.dataset.pass
            let tipo=element.dataset.tipo
            let id=element.dataset.id
            //console.log(id + tipo)
            conexionFirebase(email,pass,tipo)
            
        })
    });
    }
    function conexionFirebase(email,pass,tipo,id){
      firebase.auth().createUserWithEmailAndPassword(email, pass).then(function(user){
        let ruta=""
        if(tipo=="oferente"){
          ruta= `aprobar_oferente.php?id=${id} `
        }else{
          ruta=`aprobar_empresa.php?id=${id}`
        }
        updateMYSQL(ruta,id)
        
        }).catch(function(error) {
          // Handle Errors here.
          var errorCode = error.code;
          var errorMessage = error.message;
          // ...
      });
    }
    function updateMYSQL(ruta){
      fetch(ruta, {
                  method: 'POST' 
                }).then(res => res.text())
                  .then(response =>{
                  console.log(response)
                  console.log('La tasca es un inutil')
                });
    }
    </script>
  </body>
</html>