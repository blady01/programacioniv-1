var appBuscarAlumnos = new Vue({
    el: '#frm-buscar-alumnos',
    data: {
        misalumnos: [],
        valor: ''
    },
    methods: {
        buscarAlumno: function () {
            fetch(`private/modulos/alumnos/procesos.php?proceso=buscarAlumno&alumno=${this.valor}`).then(resp => resp.json()).then(resp => {
                this.misalumnos = resp;
            });
        },
        modificarAlumno: function (alumno) {
            appalumno.alumno = alumno;
            appalumno.alumno.accion = 'modificar';
        },
        eliminarAlumno: function (idAlumno) {
            var mensaje = confirm("¿Estas seguro de eliminar este registro?");
            if (mensaje) {
                alert("¡Se ha eliminado el registro con exito!");
                fetch(`private/modulos/alumnos/procesos.php?proceso=eliminarAlumno&alumno=${idAlumno}`).then(resp => resp.json()).then(resp => {
                    this.buscarAlumno();
                });
            } else {
                alert("¡No se ha eliminado el registro!");
            }
        }
    },
    created: function () {
        this.buscarAlumno();
    }
});
