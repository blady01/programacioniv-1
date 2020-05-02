var appBuscarPeliculas = new Vue({
    el: '#frm-buscar-peliculas',
    data: {
        mispeliculas: [],
        valor: ''
    },
    methods: {
        buscarPelicula: function () {
            fetch(`private/modulos/peliculas/procesos.php?proceso=buscarPelicula&pelicula=${this.valor}`).then(resp => resp.json()).then(resp => {
                this.mispeliculas = resp;
            });
        },
        modificarPelicula: function (pelicula) {
            apppelicula.pelicula = pelicula;
            apppelicula.pelicula.accion = 'modificar';
        },
        eliminarPelicula: function (idPelicula) {
            var mensaje = confirm("¿Estas seguro de eliminar este registro?");
            if (mensaje) {
                alert("¡Se ha eliminado el registro con exito!");
                fetch(`private/modulos/peliculas/procesos.php?proceso=eliminarPelicula&pelicula=${idPelicula}`).then(resp => resp.json()).then(resp => {
                    this.buscarPelicula();
                });
            } else {
                alert("¡No se ha eliminado el registro!");
            }
        }
    },
    created: function () {
        this.buscarPelicula();
    }
});
