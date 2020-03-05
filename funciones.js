
var sumafi=0, pos=0;
var sumaxixfi=0;
var sumaxi2xfi=0;
var moda=0;
var datos =[];

var posmoda=0;
var posmoda2=0;
var respmoda="";

function calcular(){
    let xi=parseInt(document.getElementById("txtnumero").value) ;
    let fi=parseInt(document.getElementById("txtfrecuencia").value);

    document.getElementById("txtnumero").value="";
    document.getElementById("txtfrecuencia").value="";

    datos.push(xi);
    pos=datos.length;
    
    let xixfi=0;
    let xi2xfi=0;
    
    
    sumafi +=fi;
    xixfi=xi*fi;
    xi2xfi= Math.pow(xi, 2) * fi;
    sumaxixfi += xixfi;
    sumaxi2xfi +=xi2xfi;

    console.log(pos);

    let tr=document.getElementById("tbody");

    let td= "<td>" + fi + "</td>" + "<td>" + sumafi + "</td>" + "<td>" + xixfi + "</td>" + "<td>" + xi2xfi + "</td>"

    let escructura="<tr> <th>" + xi + "</th>" + td + "</tr>"
    tr.innerHTML += escructura;

    obtenerEstadisticas(fi, pos);

}

function obtenerEstadisticas(fi, pos) {
    //Media
    let media = 0;
    media = (sumaxixfi / sumafi);
    let lblmedia = document.getElementById("lblmedia");
    lblmedia.innerHTML = "Media: " + media.toFixed(2);

    //Mediana
    let mediana=sumafi/2;
    let lblmediana=document.getElementById("lblmediana");
    lblmediana.innerHTML="Mediana: "+mediana;

    //Desviacion Tipica
    let varianza=(sumaxi2xfi/sumafi)-Math.pow(media,2);
    let desviacionTipica=Math.sqrt(varianza,2);
    console.log(desviacionTipica);
    
    let lbldestip=document.getElementById("lbldestip");
    lbldestip.innerText="Desviacion Tipica: " + desviacionTipica.toFixed(2);

    //Moda
    if(fi>moda){
        moda=fi;
        posmoda=pos;
        respmoda="Moda: " + datos[posmoda-1];
    }else if(fi==moda) {
        posmoda2=pos;
        respmoda="Es Bimodal: " + datos[posmoda - 1] + " y " + datos[posmoda2 - 1];
    }
    console.log(datos[posmoda-1]);
    let lblmoda=document.getElementById("lblmoda");
    lblmoda.innerText=respmoda;

}

function limpiar(){
    let tr=document.getElementById("tbody");

    let td= "";

    let escructura="";
    tr.innerHTML = escructura;

    let lblmedia = document.getElementById("lblmedia");
    lblmedia.innerHTML = "Media: ";

    let lblmediana=document.getElementById("lblmediana");
    lblmediana.innerHTML="Mediana: ";

    let lbldestip=document.getElementById("lbldestip");
    lbldestip.innerText="Desviacion Tipica: ";

    let lblmoda=document.getElementById("lblmoda");
    lblmoda.innerText="Moda: ";
}
