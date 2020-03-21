var sumafi=0;
var sumaxixfi=0;
var sumaxi2xfi=0;
var moda=0;
function calcular(){
    let xi=parseInt(document.getElementById("txtnumero").value) ;
    let fi=parseInt(document.getElementById("txtfrecuencia").value);

    
    let xixfi=0;
    let xi2xfi=0;
    
    
    sumafi +=fi;
    xixfi=xi*fi;
    xi2xfi= Math.pow(xi, 2) * fi;
    sumaxixfi += xixfi;
    sumaxi2xfi +=xi2xfi;

    console.log(sumafi);
    console.log(xixfi);
    


    let tr=document.getElementById("tbody");

    let td= "<td>" + fi + "</td>" + "<td>" + sumafi + "</td>" + "<td>" + xixfi + "</td>" + "<td>" + xi2xfi + "</td>"

    let escructura="<tr> <th>" + xi + "</th>" + td + "</tr>"
    tr.innerHTML += escructura;

    obtenerEstadisticas();

}

function obtenerEstadisticas() {
    //Media
    let media = 0;
    media = sumaxixfi / sumafi;
    let lblmedia = document.getElementById("lblmedia");
    lblmedia.innerHTML = "Media: " + media;

    //Mediana
    let mediana=sumafi/2;
    let lblmediana=document.getElementById("lblmediana");
    lblmediana.innerHTML="Mediana: "+mediana;

    //Desviacion Tipica
    let varianza=(sumaxi2xfi/sumafi)-Math.pow(media,2);
    let desviacionTipica=Math.sqrt(varianza,2);
    console.log(desviacionTipica);
    
    let lbldestip=document.getElementById("lbldestip");
    lbldestip.innerText="Desviacion Tipica: " + desviacionTipica;

    //Moda
    if(moda>fi){
        moda=fi;
    }
    let lblmoda=document.getElementById("lblmoda");
    lblmoda.innerText="Moda: "+moda;

}