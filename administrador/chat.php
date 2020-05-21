<?php

session_start();

if(empty($_SESSION['idAdministrador'])) {
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
    <title>Chat Administradores</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
      #messenger {
        height: 400px;
        border: 1px solid #000;
      }
    </style>
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
        <div div class="col-md-4">
          <div class="list-group">
            <a href="panel.php" class="list-group-item">Panel</a>
            <a href="oferente.php" class="list-group-item">Oferentes</a>
            <a href="empresa.php" class="list-group-item">Empresas</a>
            <a href="puesto.php" class="list-group-item">Puestos de Trabajo</a>
            <a href="caracteristicas.php" class="list-group-item">Caracteristicas</a>
            <a href="chat.php" class="list-group-item active">Chat</a>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-md-6 offset-md-3 col-sm-12">
             <form class="form-inline" v-on:submit.prevent="enviarMensaje" v-on:reset="limpiarChat" id="frm-chat">
              <div id="messenger">
                <ul v-for="msg in msgs" id="messages">
                  <li>Mensaje: {{ msg }}</li>
                </ul>
              </div><br>
              <ul class="text-center" id="InputMessages">
                <input type="text" v-model="msg" placeholder="Escribe tu Mensaje" class="form-control">
                <input type="submit" value="Enviar" class="btn btn-success">
              </ul>
             </form>
            </div>
        </div>
      </div>
    </div>
</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.dev.js"></script>
    <script>
      var socket = io.connect("http://localhost:3001",{'forceNew':true}),
          appchat = new Vue({
              el:'#frm-chat',
              data:{
                  msg : '',
                  msgs : []
              },
              methods:{
                  enviarMensaje(){
                      socket.emit('enviarMensaje', this.msg);
                      this.msg = '';
                  },
                  limpiarChat(){
                      this.msg = '';
                  }
              },
              created(){
                  socket.emit('chatHistory');
              }
          });
          socket.on('recibirMensaje',msg=>{
              console.log(msg);
              appchat.msgs.push(msg);
          });
          socket.on('chatHistory',msgs=>{
              appchat.msgs = [];
              msgs.forEach(item => {
                  appchat.msgs.push(item.msg);
              });
          });
    </script>
  </body>
</html>