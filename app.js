document.addEventListener("DOMContentLoaded", e => {

    const form = document.querySelector("#frmConversores");

    document.querySelector("#cboTipos").addEventListener("change", function(){
        
        var selDe = document.getElementById("cboDe");
        var selA = document.getElementById("cboA");

        var Convertir = document.querySelector("#cboTipos").value;

        var MonedasValor = ["dolar", "colones", "yenes", "rupia", "lempira", "peso", "bitcoin"];
        var MonedasText = ["Dolar", "Colones (SV)", "Yenes", "Rupia", "Lempiras", "Peso (MX)", "Bitcoin"];

        var AlmacenamientoValor = ["megabyte", "bit", "byte", "kilobyte", "gigabyte", "terabyte"];
        var AlmacenamientoText = ["Megabyte", "Bit", "Byte", "Kilobyte", "Gigabyte", "Terabyte"];

        var LongitudValor = ["metro", "cm", "pulgada", "pie", "varas", "yardas", "km", "millas"];
        var LongitudText = ["Metro", "Cm", "Pulgada", "Pie", "Varas", "Yardas", "Km", "Millas"];


        console.log(Convertir);

        selDe.length = 0;
        selA.length = 0;

        switch (Convertir){
            case "Divisas":
                for (let i = 0; i < MonedasValor.length; i++) {
                    selDe.options[i] = new Option(MonedasText[i],MonedasValor[i]);
                    selA.options[i] = new Option(MonedasText[i],MonedasValor[i]);
                }
                break;
            case "Almacenamiento":
                for (let i =0; i < AlmacenamientoValor.length; i++){
                    selDe.options[i] = new Option(AlmacenamientoText[i],AlmacenamientoValor[i]);
                    selA.options[i] = new Option(AlmacenamientoText[i],AlmacenamientoValor[i]);
                }
                break;
            case "Longitud":
                for (let i = 0; i < LongitudValor.length; i++) {
                    selDe.options[i] = new Option(LongitudText[i],LongitudValor[i]);
                    selA.options[i] = new Option(LongitudText[i],LongitudValor[i]);
                }
            break;
        }
    },false);

    form.addEventListener("submit",event => {
        event.preventDefault();

        let Convertir = document.querySelector("#cboTipos").value;

        let de = document.querySelector("#cboDe").value, 
            a = document.querySelector("#cboA").value,
            cantidad = document.querySelector("#txtCantidadConversor").value;

        let $res = document.querySelector("#lblRespuesta");

        let Convertidor;
    
        switch (Convertir){
            case "Divisas":
                Convertidor = {"dolar":1, "colones":8.75, "yenes":11.27, "rupia":69.75, "lempira":24.36, "peso":19.36, "bitcoin":0.00026 };
                break;
            case "Almacenamiento":
                Convertidor = {"megabyte":1, "bit":8388608, "byte":1048576, "kilobyte":1024, "gigabyte":0.0009765625, "terabyte":0.00000095367431660625};
                 break;
            case "Longitud":
                Convertidor = { "metro":1, "cm":100, "pulgada":39.3701, "pie":3.28084, "varas":1.1963081929167, "yardas":1.09361, "km": 0.001, "millas":0.000621371};
                break;
        }
        let A = Convertidor[a];
        let DE = Convertidor[de];
        let Cantidad = cantidad;
            fetch(`respuesta.php?A=${A}&DE=${DE}&Cantidad=${Cantidad}`)
                .then(resp=>resp.text())
                 .then(respuesta=>{
                    $res.innerHTML = respuesta;
                });
    });
});