<?php
if($_GET && isset($_GET['A']) && isset($_GET['DE']) && isset($_GET['Cantidad'])){
    $A = $_GET['A'];
    $DE = $_GET['DE'];
    $Cantidad = $_GET['Cantidad'];

    echo "Respuesta: ".(($A/$DE)*$Cantidad);
}else{
    header("location:index.html");
}
?>