var $ = el => document.querySelector(el),
    $$ = na => document.getElementsByName(na);
document.addEventListener("DOMContentLoaded", event => {
    let mostrarVista = $$('navSelect');

    let modulo;
    mostrarVista.forEach(element => {
        element.addEventListener('click', e => {
            e.stopPropagation();
            modulo = e.toElement.dataset.modulo;
            seleccionarPeticion(modulo);
        });
    });
});

function seleccionarPeticion(modulo) {
    fetch(`public/vistas/${modulo}/${modulo}.html`).then(resp => resp.text()).then(resp => {
        $(`#vistas-${modulo}`).innerHTML = resp;
        let btnCerrar = $(".close");
        btnCerrar.addEventListener("click", event => {
            $(`#vistas-${modulo}`).innerHTML = "";
        });
        let cuerpo = $("body"), script = document.createElement("script");
        script.src = `public/vistas/${modulo}/${modulo}.js`;
        cuerpo.appendChild(script);
    });
}