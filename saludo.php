<?php
    /** Definir la zona horaria */
    date_default_timezone_set('America/El_salvador');
    
    if($_GET && isset($_GET['nombre'])){
        $nombre = $_GET['nombre'];
        echo 'Hola '. $nombre.
        ' desde el servidor '.
        date('d-m-Y H:i:s');
    }else{
        header('location:index.html');
    }
?>