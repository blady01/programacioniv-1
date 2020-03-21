<?php
    require_once "conexion.php";
    $conexion=conexion();
    $c=$_POST['clases'];
    $f=$_POST['frecuencia'];
    $a=$_POST['frecacu'];
    $r=$_POST['xifi'];
    $x=$_POST['xi2fi'];

    $sql="INSERT into t_datos(clases, frecuencia, frecacu, xifi, xi2fi)
            values('$c','$f','$a','$r','$x')";

    echo $result=mysqli_query($conexion,$sql);
?>