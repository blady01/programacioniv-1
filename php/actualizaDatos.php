<?php
    require_once "conexion.php";
    $conexion=conexion();
    $iddato=$_POST['iddato'];
    $c=$_POST['clases'];
    $f=$_POST['frecuencia'];
    $a=$_POST['frecacu'];
    $r=$_POST['xifi'];
    $x=$_POST['xi2fi'];

    $sql="UPDATE t_datos SET clases='$c', 
                             frecuencia='$f', 
                             frecacu='$a', 
                             xifi='$r',
                             xi2fi='$x'
                WHERE iddato='$iddato'";
    echo $result=mysqli_query($conexion,$sql)
?>