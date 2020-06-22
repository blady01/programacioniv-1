//Aqui ira mi servicio en segundo plano...

self.addEventListener('push', e => {
    const data = e.data.json();
         console.log('Recibida la Notificacion PUSH: ', data);
        self.registration.showNotification(data.title, {
            body: data.pmsg.user + ': ' + data.pmsg.msg,
            icon: '../images/server-message.png'
        });
});