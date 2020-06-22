const public_key = "BHiEoiBJwgNd2ckouanLJyOvo7KR23JA2sih6Co_1ThbcbsscmULmZMZ2RS6flYis9aPd_lR3tib_w9fdOY5BgY";

if('serviceWorker' in navigator){
    navigator.serviceWorker.register('../js/sw.js').then( reg => {
        console.log('Servicio registrado');
        if(reg.installing){
            console.log("Instalando proceso en segundo plano.");
        }else if (reg.waiting){
            console.log('Servicio instalado correctamente');
        }else if (reg.active){
            console.log('Servicio instalado y listo para usarse.');

            suscribirse(reg);
        }else {
            console.log("Error al intentar registrar el servicio.");
        }
    });
}else{
    alert("Su navegador no soporta ejecución de procesos en segundo plano, por lo tanto no recibira notificaciones")
}

function suscribirse(reg){
    reg.pushManager.subscribe({
        userVisibleOnly: true,
        applicationServerKey: urlBase64ToUint8Array(public_key)
    }).then(subscription => {
        console.log("enviando la subcripcion: ", JSON.stringify(subscription));
        socket.emit('suscribirse', JSON.stringify(subscription)); //enviando a node la suscripcion para almacenar en la BD
    }).catch(error => {
        if (Notification.permission === 'denied') {
            console.log("NO me autorizo para enviarle notificaciones");
        } else {
            console.log("NO pude registrar el proceso en segundo plano: ", error);
        }
    });
}

function urlBase64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64 = (base64String + padding)
        .replace(/-/g, '+')
        .replace(/_/g, '/');

    const rawData = window.atob(base64);
    const outputArray = new Uint8Array(rawData.length);

    for (let i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
}