export function modulo() {
    var $ = el => document.querySelector(el),
        frmBuscarDocentes = $("#txtBuscarDocente");
    frmBuscarDocentes.addEventListener('keyup', e => {
        traerDatos(frmBuscarDocentes.value);
    });
    let modificarDocente = (docente) => {
        $("#frm-docentes").dataset.accion = 'modificar';
        $("#frm-docentes").dataset.iddocente = docente.idDocente;
        $("#txtCodigoDocente").value = docente.codigo;
        $("#txtNombreDocente").value = docente.nombre;
        $("#txtDuiDocente").value = docente.dui;
        $("#txtDireccionDocente").value = docente.direccion;
        $("#txtTelefonoDocente").value = docente.telefono;
    };
    let eliminarDocente = (idDocente) => {
        fetch(`private/modulos/docentes/procesos.php?proceso=eliminarDocente&docente=${idDocente}`).then(resp => resp.json()).then(resp => {
            traerDatos('');
        });
    };
    let traerDatos = (valor) => {
        fetch(`private/modulos/docentes/procesos.php?proceso=buscarDocente&docente=${valor}`).then(resp => resp.json()).then(resp => {
            let filas = '';
            resp.forEach(docente => {
                filas += `
                    <tr data-iddocente='${docente.idDocente}' data-docente='${JSON.stringify(docente)}'>
                        <td>${docente.codigo}</td>
                        <td>${docente.nombre}</td>
                        <td>${docente.dui}</td>
                        <td>${docente.direccion}</td>
                        <td>${docente.telefono}</td>
                        <td>
                            <input type="button" class="btn btn-outline-danger text-white" value="del">
                        </td>
                    </tr>
                `;
            });
            $("#tbl-buscar-docentes > tbody").innerHTML = filas;
            $("#tbl-buscar-docentes > tbody").addEventListener("click", e => {
                e.stopPropagation();

                if (e.srcElement.parentNode.dataset.docente == null) {
                    var mensaje = confirm("¿Desea eliminar el registro de docente?");
                    if (mensaje){
                        alert("¡Registro eliminado con exito!");
                        eliminarDocente(e.srcElement.parentNode.parentNode.dataset.iddocente);
                    } else {
                        alert("¡El registro no ha sido eliminado!");
                    }   
                } else {
                    modificarDocente(JSON.parse(e.srcElement.parentNode.dataset.docente));
                }
            });
        });
    };
    traerDatos('');
}