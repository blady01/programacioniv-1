var appBuscarClientes = new Vue({
    el: '#frm-buscar-clientes',
    data: {
        misclientes: [],
        valor: ''
    },
    methods: {
        buscarCliente: function () {
            fetch(`private/modulos/clientes/procesos.php?proceso=buscarCliente&cliente=${this.valor}`).then(resp => resp.json()).then(resp => {
                this.misclientes = resp;
            });
        },
        modificarCliente: function (cliente) {
            appcliente.cliente = cliente;
            appcliente.cliente.accion = 'modificar';
        },
        eliminarCliente: function (idCliente) {
            var mensaje = confirm("¿Estas seguro de eliminar este registro?");
            if (mensaje) {
                alert("¡Se ha eliminado el registro con exito!");
                fetch(`private/modulos/clientes/procesos.php?proceso=eliminarCliente&cliente=${idCliente}`).then(resp => resp.json()).then(resp => {
                    this.buscarCliente();
                });
            } else {
                alert("¡No se ha eliminado el registro!");
            }
        }
    },
    created: function () {
        this.buscarCliente();
    }
});
