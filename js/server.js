//Nota: Este archivo debe ir en la carpeta de node => C:\Program Files\nodejs
var http = require('http').Server(),
    io = require('socket.io')(http),
    MongoClient = require('mongodb').MongoClient,
    url = 'mongodb://localhost:27017',
    dbName = 'chatAdmins';

const webpush = require('web-push'),
    vapidKeys = {
        publicKey: 'BHiEoiBJwgNd2ckouanLJyOvo7KR23JA2sih6Co_1ThbcbsscmULmZMZ2RS6flYis9aPd_lR3tib_w9fdOY5BgY',
        privateKey: 'z16xcV4MEKlJxR3SX5puHwuLEl7uYTjsbIL9lZu2bAU'
    };
var pushSubcriptions; //debe de almacenarse en una BD.
webpush.setVapidDetails("mailto:vlainezt07@gmail.com", vapidKeys.publicKey, vapidKeys.privateKey);

io.on('connection', socket => {
    socket.on('enviarMensaje', (msg) => {
        MongoClient.connect(url, (err, client) => {
            const db = client.db(dbName);
            db.collection('chat').insert({
                'user': msg.user,
                'msg': msg.msg
            });
            io.emit('recibirMensaje', msg);

            try {
                const dataPush = JSON.stringify({
                    title: 'Notificacion PUSH desde el SERVIDOR',
                    pmsg: {
                        'user': msg.user,
                        'msg': msg.msg
                    }
                });
                console.log("Endpoint: ", pushSubcriptions.endpoint);
                webpush.sendNotification(pushSubcriptions, dataPush);
            } catch (error) {
                console.log("Error al intentar enviar la notificacion push", error);
            }
        });
    });
    socket.on('chatHistory', () => {
        MongoClient.connect(url, (err, client) => {
            const db = client.db(dbName);
            db.collection('chat').find({}).toArray((err, msgs) => {
                io.emit('chatHistory', msgs);
            });
        });
    });
    socket.on("suscribirse", (subcriptions) => {
        pushSubcriptions = JSON.parse(subcriptions);
        console.log(pushSubcriptions.endpoint);
    });
});
http.listen(3001, () => {
    console.log('Escuchando peticiones por el puerto 3001, LISTO');
});