<?php
    function conexion(){
        $servidor="localhost";
        $usuario="root";
        $password="";
        $bd="datosestadisticos";
        
        $conexion=mysqli_connect($servidor,$usuario,$password,$bd);

        return $conexion;
    }
?>