<?php
    require_once "../php/conexion.php";
    $conexion=conexion();
?>

<div class="row">
    <div class="cols-sm-12">
        <br>
        <h2>Cálculo de la media aritmética, mediana, moda y desviaciones tipicas-estandar</h2>
        <br>
        <table class="table table-hover table-condensed table-bordered">
            <caption>
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo">
                    Agregar Nuevo 
                    <i class="fas fa-plus"></i>
                </button>
                <button class="btn btn-success">
                    Calcular Datos
                    <i class="fas fa-calculator"></i>
                </button>
            </caption>
            <tr>
                <td>Nombres de clases (xi)</td>
                <td>Frecuencias absolutas (fi)</td>
                <td>Frecuencias absolutas acumuladas (Fi)</td>
                <td>xi*fi</td>
                <td>(xi^2)fi</td>
                <td>Editar</td>
                <td>Eliminar</td>
            </tr>
            <?php
                $sql="SELECT iddato, clases, frecuencia, frecacu, xifi, xi2fi FROM t_datos";

                $result=mysqli_query($conexion,$sql);
                while($ver=mysqli_fetch_row($result)){

                    $datos = $ver[0]."||".
                             $ver[1]."||".
                             $ver[2]."||".
                             $ver[3]."||".
                             $ver[4]."||".
                             $ver[5];
            ?>
            <tr>
                <td><?php echo $ver[1]?></td>
                <td><?php echo $ver[2]?></td>
                <td><?php echo $ver[3]?></td>
                <td><?php echo $ver[4]?></td>
                <td><?php echo $ver[5]?></td>
                <td>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos ?>')">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                </td>
                <td>
                    <button class="btn btn-danger" onclick="preguntarSiNo()">
                      <i class="fa fa-times"></i>
                    </button>
                </td>
            </tr>
            <?php
                    }
            ?>
            <tr> 
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>
</div>