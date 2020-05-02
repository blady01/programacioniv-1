var appBuscarDocentes = new Vue({
    el: '#frm-buscar-docentes',
    data: {
        misdocentes: [],
        valor: ''
    },
    methods: {
        buscarDocente: function () {
            fetch(`private/modulos/docentes/procesos.php?proceso=buscarDocente&docente=${this.valor}`).then(resp => resp.json()).then(resp => {
                this.misdocentes = resp;
            });
        },
        modificarDocente: function (docente) {
            appdocente.docente = docente;
            appdocente.docente.accion = 'modificar';
        },
        eliminarDocente: function (idDocente) {
            var mensaje = confirm("¿Estas seguro de eliminar este registro?");
            if(mensaje){
                alert("¡Se ha eliminado el registro con exito!");
                fetch(`private/modulos/docentes/procesos.php?proceso=eliminarDocente&docente=${idDocente}`).then(resp => resp.json()).then(resp => {
                this.buscarDocente();
                });
            } else {
                alert("¡No se ha eliminado el registro!");
            }
        }
    },
    created: function () {
        this.buscarDocente();
    }
});
