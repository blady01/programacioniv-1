var appBuscarMaterias = new Vue({
    el: '#frm-buscar-materias',
    data:{
        mismaterias:[],
        valor:''
    },
    methods:{
        buscarMateria: function(){
            fetch(`private/modulos/materias/procesos.php?proceso=buscarMateria&materia=${this.valor}`).then(resp => resp.json()).then(resp => {
                this.mismaterias = resp;
            });
        },
        modificarMateria: function(materia){
            appmateria.materia = materia;
            appmateria.materia.accion = 'modificar';
        },
        eliminarMateria: function(idMateria){
            var mensaje = confirm("¿Estas seguro de eliminar este registro?");
            if (mensaje) {
                alert("¡Se ha eliminado el registro con exito!");
                fetch(`private/modulos/materias/procesos.php?proceso=eliminarMateria&materia=${idMateria}`).then(resp => resp.json()).then(resp =>{
                    this.buscarMateria();
                });
            } else {
                alert("¡No se ha eliminado el registro!");
            }
        }
    },
    created: function() {
        this.buscarMateria();
    }
});