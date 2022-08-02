let navegador = navigator.userAgent;
if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {
    console.log("Estás usando un dispositivo móvil!!");
    // alert(navigator.userAgent);
} else {  

    Swal.fire({
        icon: 'info',
        title: 'Lo Sentimos..',
        text: 'Lo sentimos mucho, por favor Acceda por un dispositivo Móvil.',
    })    

    setTimeout(() => {
        location.href = "/";        
    }, 1000);

}

const verificarVoto = () => {
    if(localStorage.getItem("voto") === null){
        console.log('Puede votar');
    }else{
        if( localStorage.getItem("voto")  === 'true'){
            location.href = ref;
        }else{
            location.href = ref;
        }
    }
}

const alertaGrafico = () =>{

    if(localStorage.getItem("voto") === null){
        if($("#linkVoto").length > 0){
            $("#linkVoto").attr('disabled', false);
            $("#linkVoto").show();
            
        }

        if($("#alertVoto").length > 0){
            $("#alertVoto").removeClass('d-block');
            $("#alertVoto").addClass('d-none');
            $("#alertVoto").removeClass('bg-gradient-success');
            $("#alertVoto").addClass('bg-gradient-info');            
        }
    }else{
        if( localStorage.getItem("voto")  === 'true'){
            if($("#linkVoto").length > 0){
                $("#linkVoto").attr("href", "#");
                $("#linkVoto").attr('disabled', true);
                $("#linkVoto").text('VOTO REALIZADO');
                $("#linkVoto").hide();
                   
            }
    
            if($("#alertVoto").length > 0){
                $("#alertVoto").removeClass('d-none');
                $("#alertVoto").addClass('d-block');            
                $("#alertVoto").text('Usted ya participó, espera la proxima apertura.');
                $("#alertVoto").removeClass('bg-gradient-info');
                $("#alertVoto").addClass('bg-gradient-success');             
            }
        }
    }    
    
}
