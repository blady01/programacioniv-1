<?php
session_start();
if(empty($_SESSION['id_usuario'])) {
  header("Location: ../index.php");
  exit();
}
require_once("../conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Ver Puesto</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
  
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/tablas.css">
    <link rel="stylesheet" href="../css/menu.css">


  </head>
  <body>
    
   <!------INCLUYENDO EL MENU -------->
    <?php include("../menu.php"); ?>
    <!---------------------------------->

    <div class="container">

       <?php if(isset($_SESSION['jobPostSuccess'])) { ?>
        <div class="row">
          <div class="alert alert-success">
            Puesto de Trabajo creado exitosamente!
          </div>
        </div>
      <?php unset($_SESSION['jobPostSuccess']); } ?>

      <?php if(isset($_SESSION['jobPostUpdateSuccess'])) { ?>
        <div class="row">
          <div class="alert alert-success">
            Puesto de Trabajo actualizado exitosamente!
          </div>
        </div>
      <?php unset($_SESSION['jobPostUpdateSuccess']); } ?>

      <?php if(isset($_SESSION['jobPostDeleteSuccess'])) { ?>
        <div class="row">
          <div class="alert alert-success">
           Puesto de Trabajo borrado correctamente!
          </div>
        </div>
      <?php unset($_SESSION['jobPostDeleteSuccess']); } ?>


      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <h2 class="text-center">Trabajos Publicados</h2>
            <table class="table table-striped">
              <thead>
                <th>Nombre del Trabajo</th>
                <th>Descripción </th>
                <th>Salario</th>
                <th>Numero de Vacantes</th>
                <th>Estado Puesto</th>
                <th>Responsabilidades</th>
                <th>Fecha </th>
                <!--<th>Acción</th>-->
              </thead>
              <tbody>
                <?php 
                  $sql = "SELECT * FROM puestos WHERE idEmpresa='$_SESSION[id_usuario]'";
                  $result = $conn->query($sql);
                  if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) 
                    {
                     ?>
                      <tr>
                        <td><?php echo $row['nombrePuesto']; ?></td>
                        <td><?php echo $row['descripcion']; ?></td>
                        <td><?php echo $row['salario']; ?></td>
                        <td><?php echo $row['numVacantes']; ?></td>
                        <td><?php echo $row['estadoPuesto']; ?></td>
                        <td><?php echo $row['responsabilidades']; ?></td>
                        <td><?php echo date("d-M-Y", strtotime($row['fecha'])); ?></td>
                        <!--
                        <td><a href="editar_puestoTrabajo.php?id=<?php echo $row['idPuesto']; ?>">Editar</a> <a href="borrar_puestoTrabajo.php?id=<?php echo $row['idPuesto']; ?>">Borrar</a></td>
                      -->
                      </tr>

                     <?php
                    }
                  }
                  $conn->close();
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function(event) {
         let contador = sessionStorage.getItem('cont')
         if(!contador==1){
          alertify.set('notifier', 'position', 'top-center');
          alertify.success('Bienvenido')
          sessionStorage.setItem('cont', '1')
         } 
   
});
</script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>