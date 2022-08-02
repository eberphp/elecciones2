let navegador = navigator.userAgent;
let veri = false;
// 
if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {
    var win = navigator.platform.indexOf('Win')  > -1;
    if(win){
        veri = false;
    }else{
        veri = true;
    }
} else {
    var win = navigator.platform.indexOf('Win')  > -1;
    if(win){
        veri = false;
    }else{
        veri = true;
    }
}

const verificarVoto = () => {
    if (localStorage.getItem("voto"+encuesta) === null) {
    } else {
        if (localStorage.getItem("voto"+encuesta) === encuesta) {
            location.href = ref;
        }
    }
}

const alertaGrafico = () => {
    const linkVoto = document.getElementById('linkVoto');
    const alertVoto = document.getElementById('alertVoto');

    if (localStorage.getItem("voto"+encuesta) === null) {
        if (linkVoto) {
            linkVoto.setAttribute('disabled', false);
            linkVoto.style.display = 'block';
        }

        if (alertVoto) {
            alertVoto.classList.remove('d-block');
            alertVoto.classList.add('d-none');
            alertVoto.classList.remove('bg-gradient-success');
            alertVoto.classList.add('bg-gradient-info');
        }
    } else {
        if (localStorage.getItem("voto"+encuesta) === encuesta) {
            if (linkVoto) {
                linkVoto.setAttribute('disabled', true);
                linkVoto.style.display = 'none';
                linkVoto.innerText = 'VOTO REALIZADO';
            }

            if (alertVoto) { 
                alertVoto.classList.remove('d-none');
                alertVoto.classList.add('d-block');
                alertVoto.classList.remove('bg-gradient-info');
                alertVoto.classList.add('bg-gradient-success');
                alertVoto.innerText = 'Usted ya participó, espera la proxima apertura.';
            }
        }
    }


}
