
var facumulada=0;
function agregardatos(clases,frecuencia){
    
    let xi=parseInt(clases) ;
    let fi=parseInt(frecuencia);

    facumulada +=fi;
    let xixfi=xi*fi;
    let xi2xfi=Math.pow(xi, 2) * fi;

    console.log(xixfi);
    
    cadena="clases=" + clases + 
            "&frecuencia=" + frecuencia + 
            "&frecacu=" + facumulada + 
            "&xifi=" + xixfi + 
            "&xi2fi=" + xi2xfi;

    $.ajax({
        type:"POST",
        url:"php/agregarDatos.php",
        data:cadena,
        success:function(r){
            if(r==1){
                $('#table-di').load('components/table.php');
                alertify.success("Agregado con exito.");
            }else{
                alertify.error("Fallo el servidor.");
            }
        }
    });
}

function agregaform(datos){

    d=datos.split('||');

    $('#iddato').val(d[0]);
    $('#clasesu').val(d[1]);
    $('#frecuenciau').val(d[2]);
    $('#frecacuu').val(d[3]);
    $('#xifiu').val(d[4]);
    $('#xi2fiu').val(d[5]); 
}

function actualizaDatos(){

    iddato=$('#iddato').val();
    clases=$('#clasesu').val();
    frecuencia=$('#frecuenciau').val();
    frecacu=$('#frecacuu').val();
    xifi=$('#xifiu').val();
    xi2fi=$('#xi2fiu').val(); 

    cadena="iddato=" + iddato +
            "&clases=" + clases + 
            "&frecuencia=" + frecuencia + 
            "&frecacu=" + frecacu + 
            "&xifi=" + xifi + 
            "&xi2fi=" + xi2fi;

        $.ajax({
            type:"POST",
            url:"php/actualizaDatos.php",
            data:cadena,
            success:function(r){
                if(r==1){
                     $('#table-di').load('components/table.php');
                    alertify.success("Actualizado con exito.");
                }else{
                   alertify.error("Fallo el servidor.");
                }
            }
        });
}

function preguntarSiNo(iddato){
    alertify.confirm('Eliminar datos', '¿Esta seguro de eliminar este registro?', 
                  function(){ eliminarDatos(iddato) }
                , function(){ alertify.error('Se cancelo')});
}

function eliminarDatos(iddato){
    cadena="iddato=" + iddato;

    $.ajax({
        type:"POST",
        url:"php/eliminarDatos.php",
        data:cadena,
        success:function(r){
            if(r==1){
                $('#table-di').load('components/table.php');
                alertify.success("Eliminado con exito");
            }else{
                alertify.error("Fallo el servidor");
            }
        }
    });
}