// conectamos a nuestro servidor socket.io activo en nodejs
var socket = io.connect("http://localhost:3001", {
        'forceNew': true
    }),
    appchat = new Vue({
        el: '#frm-chat',
        data: {
            msg: '',
            msgs: []
        },
        methods: {
            //metodo que guarda los mensajes en nuestro servidor socket.io en nodejs
            enviarMensaje() {
                //guardamos los valores de usuario y mensaje en una variable en un JSONArray 
                var datos = {
                    user: document.querySelector("#User").value,
                    msg: this.msg
                };
                socket.emit('enviarMensaje', datos);
                socket.emit('chatHistory');
                this.msg = '';
            },
            limpiarChat() {
                this.msg = '';
            }
        },
        created() {
            socket.emit('chatHistory');
        }
    });
socket.on('recibirMensaje', msg => {
    //envio de notificaciones cross browser
    if(msg.user != document.querySelector('#User').value){
        var nmsg = msg.user + ": " + msg.msg;
        $.notification("Enviando noficacion", nmsg, '../images/iconochat.png');
    }  
});
socket.on('chatHistory', msgs => {
    //extraer los mensajes de nuestro servidor
    appchat.msgs = [];
    msgs.forEach(item => {
        appchat.msgs.push(item);
    });
});