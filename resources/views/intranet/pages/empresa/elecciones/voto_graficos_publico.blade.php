@extends('intranet.layouts.public')
@section('style')
    <style>
        @media only screen and (min-width: 768px) {
        /* For desktop: */
        .graf{height: 300px;}
    }
    </style>
@endsection
@section('content')
    <div class="container-fluid py-2">
        <div class="row mt-2">
            <div class="col-12">
                <div class="card shadow-lg">
                    <!-- Card header -->
                    <div class="card-header bg-gradient-info ">
                        <div class="row ">
                            <div class="col-12 col-md-8 mb-3">
                                <h5 class="mb-0 text-white " style="font-size: 15px;">{{ $encuesta->nombreEncuesta }} -
                                    GRÁFICOS / Por Ubicación y
                                    Resultado Total</h5>
                            </div>
                            <div class="col-12 col-md-4 text-end">
                                <a href="{{ route('/') }}" class="btn btn-info w-100 w-md-25">Volver</a>
                            </div>
                        </div>
                        <p class="text-sm mb-0">
                        </p>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col 12 col-md-5">
                                <div class="row">
                                    <div class="col-12 mb-3 d-flex justify-content-center align-items-center">
                                        <span class="text-info fw-bold" style="font-size: 14px;">Vigencia: Del
                                            {{ $encuesta->fechaInicio }} al {{ $encuesta->fechaTermino }}
                                        </span>
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <select class="form-control" name="resultado" id="resultado">
                                            <option value="Total" selected>Resultado Total</option>
                                            <option value="Ubicacion">Por Ubicación</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-6 py-2">
                                        <div class="wrapper">
                                            <div
                                                class="d-flex justify-content-center align-items-center text-center px-3 z-index-2">
                                                <span class="fw-bold mx-1" style="font-size: 12px;">Días<div
                                                        class="day btn btn-xs bg-gradient-secondary text-white"></div>
                                                </span>
                                                <span class="fw-bold mx-1" style="font-size: 12px;">Horas<div
                                                        class="hours btn btn-xs bg-gradient-secondary text-white"></div>
                                                </span>
                                                <span class="fw-bold mx-1" style="font-size: 12px;">Min<div
                                                        class="minutes btn btn-xs bg-gradient-secondary text-white"></div>
                                                </span>
                                                <span class="fw-bold mx-1" style="font-size: 12px;">Sec<div
                                                        class="seconds btn btn-xs bg-gradient-secondary text-white"></div>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-3 text-center">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <span id="linkVoto"
                                            data-url="{{ route('Votos.dispositivo', ['encuesta' => Crypt::encryptString($encuesta->idEncuesta)]) }}"
                                            class="btn btn-sm w-100 bg-gradient-info mx-1">Votar</span>

                                        <span id="alertVoto"
                                            class="d-block fw-bold d-none text-white btn btn-sm bg-gradient-info"
                                            style="font-size: 14px;">Usted ya
                                            participó, espera la proxima apertura.</span>
                                    </div>

                                    <div class="col-12 text-center">

                                        <select name="anteriores" id="anteriores" class="form-control text-center">
                                            <option value="">--- Encuestas Anteriores ---</option>
                                            @foreach ($encuestas as $publicado)
                                                <option
                                                    value="{{ route('Votos.grafico.publico', ['encuesta' => Crypt::encryptString($publicado->idEncuesta)]) }}">
                                                    {{ $publicado->fechaTermino }} -
                                                    {{ $publicado->publicacion == 'Si' ? 'Publicado' : 'En Proceso' }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <!-- Sumatoria de votos -->
                            </div>

                        </div>
                    </div>

                </div>
                <div class="card mt-3 shadow-lg {{ $encuesta->publicacion == 'Si' ? '' : 'd-none' }}">
                    <div class="card-header bg-gradient-success text-white">
                        <div class="row">
                            <div class="col-12 col-md-3 mb-3">
                                <label for="departamento" class="text-white">Departamento</label>
                                <select name="departamento" id="departamento" class="form-control" required
                                    onchange="getProvincias(departamento)">
                                    <option value="">-- Seleccione --</option>
                                    @foreach ($departamentos as $departamento)
                                        <option value="{{ $departamento->id }}">{{ $departamento->departamento }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Campo requerido*</div>
                            </div>

                            <div class="col-12 col-md-3 mb-3">
                                <label for="provincia" class="text-white">Provincia</label>
                                <select name="provincia" id="provincia" class="form-control" required
                                    onchange="getDistritos()">
                                    <option value="">-- Seleccione --</option>
                                </select>
                                <div class="invalid-feedback">Campo requerido*</div>
                            </div>

                            <div class="col-12 col-md-3 mb-3">
                                <label for="distrito" class="text-white">Distrito</label>
                                <select name="distrito" id="distrito" class="form-control" required onchange="getZonas(0)">
                                    <option value="">-- Seleccione --</option>
                                </select>
                                <div class="invalid-feedback">Campo requerido*</div>
                            </div>

                            <div class="col-12 col-md-3 mb-3">
                                <label for="" class="text-white">Zona</label>
                                <select name="zona" id="zona" class="form-control" required disabled
                                    onchange="getVotosDepartamento()">
                                    <option value="" selected>-- TODOS --</option>
                                </select>
                                <div class="invalid-feedback">Campo requerido*</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div> <!-- End CArr -->

            @if ($encuesta->publicacion == 'Si')
                <div class="row mb-3 mt-3" style="padding-right: 0;">
                    <div class="col-12 col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="chart-departamento" class="chart-canvas graf" height="220px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="chart-provincia" class="chart-canvas graf" height="220px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="chart-distrito" class="chart-canvas graf" height="220px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>


    <div class="position-fixed top-0 start-50 translate-middle-x z-index-2">

        @if (Session('success'))
            <div class="toast fade p-2 mt-2 bg-gradient-success show" role="alert" aria-live="polite" id="infoToast"
                aria-atomic="true" data-bs-delay="10">
                <div class="toast-header bg-transparent border-0">
                    <i class="ni ni-bell-55 text-white me-2"></i>
                    <span class="me-auto text-white font-weight-bold">{{ config('app.name') }} - Encuestas</span>
                    <i class="fas fa-times text-md text-white ms-3 cursor-pointer" data-bs-dismiss="toast"
                        aria-label="Close" aria-hidden="true"></i>
                </div>
                <hr class="horizontal light m-0">
                <div class="toast-body text-white">{{ Session('success') }}</div>
            </div>
        @endif

        @if (Session('fail'))
            <div class="toast fade p-2 mt-2 bg-gradient-danger show" role="alert" aria-live="polite" id="dangerToas"
                aria-atomic="true" data-bs-delay="10">
                <div class="toast-header bg-transparent border-0">
                    <i class="ni ni-bell-55 text-white me-2"></i>
                    <span class="me-auto text-white font-weight-bold">{{ config('app.name') }} - Encuestas</span>
                    <i class="fas fa-times text-md text-white ms-3 cursor-pointer" data-bs-dismiss="toast"
                        aria-label="Close" aria-hidden="true"></i>
                </div>
                <hr class="horizontal light m-0">
                <div class="toast-body text-white">{{ Session('fail') }}</div>
            </div>
        @endif


    </div>
@endsection

@section('script')
    <script src="{{ asset('admin/assets/js/plugins/multistep-form.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/datatables.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/sweetalert.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/chartjs.min.js') }}"></script>
    <script src="https://unpkg.com/chart.js-plugin-labels-dv@3.0.5/dist/chartjs-plugin-labels.min.js"></script>
    <script>
        let ref = "{{ route('Votos.grafico.publico', ['encuesta' => Crypt::encryptString($encuesta->idEncuesta)]) }}";
        let encuesta = "{{ $encuesta->idEncuesta }}";
    </script>
    <script src="{{ asset('js/indexdb.js') }}"></script>

    <script>
        let dataTableSearch;
        let dataVotos = {
            votoReg: [],
            votoPro: [],
            votoDis: [],
        };

        const anteriores = document.getElementById('anteriores');

        anteriores.addEventListener('change', (e) => {
            if (e.target.value !== '') {
                location.href = e.target.value
            }
        })

        const linkVoto = document.getElementById('linkVoto');

        linkVoto.addEventListener('click', (e) => {
            if (e.target.dataset.url !== '' && veri) {
                location.href = e.target.dataset.url
            } else {
                Swal.fire({
                    icon: 'info',
                    title: 'Lo Sentimos..',
                    text: 'Sólo disponible en Móvil',
                })
            }
        })


        $("#resultado").change((e) => {

            if (e.currentTarget.value == 'Ubicacion') {
                $("#zona").attr('disabled', false);
                $("#zona option[value='']").attr("selected", true);
                $("#zona option[value='']").text("-- Selecciona --");
            } else {
                $("#zona").attr('disabled', true);
                $("#zona").html('<option value="">-- TODO --</option>')
            }

            getZonas();
            getVotosDepartamento();
        })

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn bg-gradient-success',
                cancelButton: 'btn bg-gradient-danger'
            },
            buttonsStyling: false
        })

        window.addEventListener('DOMContentLoaded', (event) => {

            alertaGrafico();

            $("#departamento").val(1);
            getProvincias();

        });
    </script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;

        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <script>
        function getProvincias() {
            let idDepartamento = $('#departamento').val();
            let ip = window.location.origin;
            $.ajax({
                url: ip + "/getProvincias/" + idDepartamento,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    var fila = "";
                    for (let i = 0; i < res.length; i++) {
                        fila += '<option value="' + res[i].id + '">' + res[i].provincia + '</option>';

                    }
                    $("#provincia option").remove();
                    $("#provincia").append(fila);
                    getDistritos(res[0].id);
                }
            })
        }

        function getDistritos(id) {
            let idProvincia = $('#provincia').val();
            let ip = window.location.origin;
            $.ajax({
                url: ip + "/getDistritos/" + idProvincia,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    var fila = "";
                    for (let i = 0; i < res.length; i++) {
                        fila += '<option value="' + res[i].id + '">' + res[i].distrito + '</option>';

                    }
                    $("#distrito option").remove();
                    $("#distrito").append(fila);
                    getZonas(res[0].id);
                    getVotosDepartamento();
                }
            });
        }

        const getZonas = (id) => {
            let departamento = $('#departamento').val();
            let provincia = $('#provincia').val();
            let distrito = $('#distrito').val();
            $.ajax({
                url: "/" + departamento + "/" + provincia + "/" + distrito + "/Zonas",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    var fila = "<option value='' selected>-- TODOS --</option>";
                    for (let i = 0; i < res.length; i++) {
                        fila += '<option value="' + res[i].id + '">' + res[i].zona + '</option>';

                    }
                    $("#zona option").remove();
                    $("#zona").append(fila);

                    getVotosDepartamento();
                }
            });
        };
    </script>
    <script>
        function updateClock() {
            var today = new Date();
            today.setHours(today.getHours() - 5);
            const todaysDate = today.getTime();
            const futureDate = new Date('{{ $encuesta->fechaTermino }}').getTime();
            const timeInMilliSecs = futureDate - todaysDate;
            const nDays = Math.floor(timeInMilliSecs / 1000 / 60 / 60 / 24);
            const nHours = Math.floor(((timeInMilliSecs / 1000 / 60 / 60 / 24) - nDays) * 24);
            const nMins = Math.floor((((timeInMilliSecs / 1000 / 60 / 60 / 24) - nDays) * 24 - nHours) * 60);
            const nSecs = Math.floor(((((timeInMilliSecs / 1000 / 60 / 60 / 24) - nDays) * 24 - nHours) * 60 - nMins) * 60);
            document.querySelector(".day").innerHTML = nDays;
            document.querySelector(".hours").innerHTML = nHours;
            document.querySelector(".minutes").innerHTML = nMins;
            document.querySelector(".seconds").innerHTML = nSecs;
            setTimeout(updateClock, 1000);
        }
        updateClock();
    </script>
    <script>
        let chDep, chPro, chDis;
        let iDe, iPr, iDi;

        //Data maxima a Mostrarse en Graficos 9 = 10 datas;
        let dataView = 9; dataMax = 10;

        const getVotosDepartamento = () => {         

            let departamento = $('#departamento').val();
            let provincia = $('#provincia').val();
            let distrito = $('#distrito').val();
            let zona = $('#zona').val();
            if (zona == '') {
                zona = 'Todos';
            }

            $.ajax({
                url: "/Votos/{{ $encuesta->idEncuesta }}/" + departamento + "/" + provincia + "/" + distrito +
                    "/" + zona +
                    "/Graficos/Total",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    setGraficos(res);
                }
            });
        }

        const setGraficos = (res) => {
            let labDep = [],
                lebPro = [],
                labDis = [];
            let imgDep = [],
                imgPro = [],
                imgDis = [];
            let dataDep = [],
                dataPro = [],
                dataDis = [];
            let totalDep = 0,
                totalPro = 0,
                totalDis = 0;
            const urls = 'https://images.pexels.com/photos/6266317/pexels-photo-6266317.jpeg?cs=srgb&dl=pexels-ann-h-6266317.jpg&fm=jpg';

            res.forEach(el => {
                let  fd;

                if (el.cReg.length > 0) {

                    if(el.cReg[0].visualiza === 'Si'){
                            fd = (el.cReg[0].foto === "") ?  urls : `{{ asset('img/fotos/') }}/` + el.cReg[0].foto;
                    }else{
                        fd = urls;
                    }   
                    
                    imgDep.push({
                        src: fd,
                        src1: (el.logotipo === "") ? urls : `{{ asset('img/logotipos/') }}/` + el.logotipo,
                        width: 20,
                        height: 24,
                        value: el.Regional[0].total
                    });
                }

                if (el.cPro.length > 0) {

                    if(el.cPro[0].visualiza === 'Si'){
                            fd = (el.cPro[0].foto === "") ?  urls : `{{ asset('img/fotos/') }}/` + el.cPro[0].foto;
                    }else{
                        fd = urls;
                    } 

                    imgPro.push({
                        src: fd,
                        src1: (el.logotipo === "") ? urls : `{{ asset('img/logotipos/') }}/` + el.logotipo,
                        width: 20,
                        height: 24,
                        value: el.Provincial[0].total
                    });
                }

                if (el.cDis.length > 0) {

                    if(el.cDis[0].visualiza === 'Si'){
                            fd = (el.cDis[0].foto === "") ?  urls : `{{ asset('img/fotos/') }}/` + el.cDis[0].foto;
                    }else{
                        fd = urls;
                    }

                    imgDis.push({
                        src: fd,
                        src1: (el.logotipo === "") ? urls : `{{ asset('img/logotipos/') }}/` + el.logotipo,
                        width: 20,
                        height: 24,
                        value: parseInt(el.Distrital[0].total)
                    });
                }


                dataDep.push(parseInt(el.Regional[0].total));
                dataPro.push(parseInt(el.Provincial[0].total));
                dataDis.push(parseInt(el.Distrital[0].total));

                totalDep += parseInt(el.Regional[0].total);
                totalPro += parseInt(el.Provincial[0].total);
                totalDis += parseInt(el.Distrital[0].total);
            });

            // ORDEN DEPARTAMENTO
            let dataDeps = dataDep.sort((a, b) => {
                if (a == b) {
                    return 0;
                }
                if (a > b) {
                    return -1;
                }
                return 1;
            })

            dataDeps.forEach((el, key) =>{
                let porDep = ((el / totalDep) * 100).toFixed(2);
                if (isNaN(porDep)) {
                    porDep = 0;
                }
                labDep.push(porDep + '%');
            })

            // ORDEN PROVINCIAL
            let dataPros = dataPro.sort((a, b) => {
                if (a == b) {
                    return 0;
                }
                if (a > b) {
                    return -1;
                }
                return 1;
            })

            dataPros.forEach((el, key) =>{
                let porPro = ((el / totalPro) * 100).toFixed(2);
                if (isNaN(porPro)) {
                    porPro = 0;
                }
                lebPro.push(porPro + '%');
            })

            // ORDEN DISTRITAL
            let dataDiss = dataDis.sort((a, b) => {
                if (a == b) {
                    return 0;
                }
                if (a > b) {
                    return -1;
                }
                return 1;
            })

            dataDiss.forEach((el, key) =>{
                let porDis = ((el / totalDis) * 100).toFixed(2);
                if (isNaN(porDis)) {
                    porDis = 0;
                }
                labDis.push(porDis + '%');
            });


            setGraDep(labDep, dataDep, imgDep.sort((a, b) => {
                return b.value - a.value;
            }), totalDep);
            iDe = imgDep.sort((a, b) => {
                return b.value - a.value;
            });
            setGraPro(lebPro, dataPro, imgPro.sort((a, b) => {
                return b.value - a.value;
            }), totalPro);
            iPr = imgPro.sort((a, b) => {
                return b.value - a.value;
            });
            setGraDis(labDis, dataDis, imgDis.sort((a, b) => {
                return b.value - a.value;
            }), totalDis);
            iDi = imgDis.sort((a, b) => {
                return b.value - a.value;
            });

        }

        const moveChartDep = {
            id: "chart-departamento",
            beforeDraw(chart, args, options){
                
            },
            afterEvent(chart, args){
                const { ctx, canvas, chartArea: {left, right, top, bottom, width, height}} = chart;

                canvas.addEventListener('mousemove', (event)=>{
                    const x = args.event.x;
                    const y = args.event.y;
                    if(x >= left - 15 && x <= left + 15 && y >= height / 2 + top - 15 && y <= height / 2 + top + 15 ){
                        canvas.style.cursor = 'pointer';
                    }else if(x >= right - 15 && x <= right + 15 && y >= height / 2 + top - 15 && y <= height / 2 + top + 15 ){
                        canvas.style.cursor = 'pointer';
                    }else{
                        canvas.style.cursor = 'default';
                    }
                })
            },
            afterDraw(chart, args, pluginOptions){
                const { ctx, chartArea: {left, right, top, bottom, width, height}, scales:{ x, y} } = chart;

                ctx.save();
                let ims;
                iDe.forEach((el, index) => {
                    let img = new Image();
                    img.src = iDe[index].src1;
                    ctx.drawImage(img, x.getPixelForValue(index) + 1, y.getPixelForValue(parseInt(iDe[index].value)) - 10, 9, 9);
                });

                class CircleChevron{

                    draw(ctx, x1, pixel){
                        const angle = Math.PI / 180;

                        ctx.beginPath();
                        ctx.lineWith = 3;
                        ctx.strokeStyle = 'rgba(102, 102, 102, 0.5)';
                        ctx.fillStyle = 'white';
                        ctx.arc(x1, height / 2 + top, 15, angle * 0, angle * 360, false);
                        ctx.stroke();
                        ctx.fill();
                        ctx.closePath();

                        // Flecha Izquierda
                        ctx.beginPath();
                        ctx.lineWith = 5;
                        ctx.strokeStyle = 'rgba(255, 26, 104, 1)';
                        ctx.moveTo(x1 + pixel, height / 2 + top - 7.5);
                        ctx.lineTo(x1 - pixel, height / 2 + top);
                        ctx.lineTo(x1 + pixel, height / 2 + top + 7.5);
                        ctx.stroke();
                        ctx.closePath();
                    }
                }

                let drawCiecleLeft = new CircleChevron();
                drawCiecleLeft.draw(ctx, left, 5);

                let drawCiecleRight= new CircleChevron();
                drawCiecleRight.draw(ctx, right, -5);                
            }
        }

        const moveChartPro = {
            id: "chart-departamento",
            beforeDraw(chart, args, options){
                
            },
            afterEvent(chart, args){
                const { ctx, canvas, chartArea: {left, right, top, bottom, width, height}} = chart;

                canvas.addEventListener('mousemove', (event)=>{
                    const x = args.event.x;
                    const y = args.event.y;
                    if(x >= left - 15 && x <= left + 15 && y >= height / 2 + top - 15 && y <= height / 2 + top + 15 ){
                        canvas.style.cursor = 'pointer';
                    }else if(x >= right - 15 && x <= right + 15 && y >= height / 2 + top - 15 && y <= height / 2 + top + 15 ){
                        canvas.style.cursor = 'pointer';
                    }else{
                        canvas.style.cursor = 'default';
                    }
                })
            },
            afterDraw(chart, args, pluginOptions){
                const { ctx, chartArea: {left, right, top, bottom, width, height}, scales:{ x, y} } = chart;

                ctx.save();
                let ims;
                iPr.forEach((el, index) => {
                    let img = new Image();
                    img.src = iPr[index].src1;
                    ctx.drawImage(img, x.getPixelForValue(index) + 1, y.getPixelForValue(parseInt(iPr[index].value)) - 10, 9, 9);
                });

                class CircleChevron{

                    draw(ctx, x1, pixel){
                        const angle = Math.PI / 180;

                        ctx.beginPath();
                        ctx.lineWith = 3;
                        ctx.strokeStyle = 'rgba(102, 102, 102, 0.5)';
                        ctx.fillStyle = 'white';
                        ctx.arc(x1, height / 2 + top, 15, angle * 0, angle * 360, false);
                        ctx.stroke();
                        ctx.fill();
                        ctx.closePath();

                        // Flecha Izquierda
                        ctx.beginPath();
                        ctx.lineWith = 5;
                        ctx.strokeStyle = 'rgba(255, 26, 104, 1)';
                        ctx.moveTo(x1 + pixel, height / 2 + top - 7.5);
                        ctx.lineTo(x1 - pixel, height / 2 + top);
                        ctx.lineTo(x1 + pixel, height / 2 + top + 7.5);
                        ctx.stroke();
                        ctx.closePath();
                    }
                }

                let drawCiecleLeft = new CircleChevron();
                drawCiecleLeft.draw(ctx, left, 5);

                let drawCiecleRight= new CircleChevron();
                drawCiecleRight.draw(ctx, right, -5);                
            }
        }

        const moveChartDis = {
            id: "chart-departamento",
            beforeDraw(chart, args, options){
                
            },
            afterEvent(chart, args){
                const { ctx, canvas, chartArea: {left, right, top, bottom, width, height}} = chart;

                canvas.addEventListener('mousemove', (event)=>{
                    const x = args.event.x;
                    const y = args.event.y;
                    if(x >= left - 15 && x <= left + 15 && y >= height / 2 + top - 15 && y <= height / 2 + top + 15 ){
                        canvas.style.cursor = 'pointer';
                    }else if(x >= right - 15 && x <= right + 15 && y >= height / 2 + top - 15 && y <= height / 2 + top + 15 ){
                        canvas.style.cursor = 'pointer';
                    }else{
                        canvas.style.cursor = 'default';
                    }
                })
            },
            afterDraw(chart, args, pluginOptions){
                const { ctx, chartArea: {left, right, top, bottom, width, height}, scales:{ x, y} } = chart;

                ctx.save();
                let ims;
                iDi.forEach((el, index) => {
                    let img = new Image();
                    img.src = iDi[index].src1;
                    ctx.drawImage(img, x.getPixelForValue(index) + 1, y.getPixelForValue(parseInt(iDi[index].value)) - 10, 9, 9);
                });

                class CircleChevron{

                    draw(ctx, x1, pixel){
                        const angle = Math.PI / 180;

                        ctx.beginPath();
                        ctx.lineWith = 3;
                        ctx.strokeStyle = 'rgba(102, 102, 102, 0.5)';
                        ctx.fillStyle = 'white';
                        ctx.arc(x1, height / 2 + top, 15, angle * 0, angle * 360, false);
                        ctx.stroke();
                        ctx.fill();
                        ctx.closePath();

                        // Flecha Izquierda
                        ctx.beginPath();
                        ctx.lineWith = 5;
                        ctx.strokeStyle = 'rgba(255, 26, 104, 1)';
                        ctx.moveTo(x1 + pixel, height / 2 + top - 7.5);
                        ctx.lineTo(x1 - pixel, height / 2 + top);
                        ctx.lineTo(x1 + pixel, height / 2 + top + 7.5);
                        ctx.stroke();
                        ctx.closePath();
                    }
                }

                let drawCiecleLeft = new CircleChevron();
                drawCiecleLeft.draw(ctx, left, 5);

                let drawCiecleRight= new CircleChevron();
                drawCiecleRight.draw(ctx, right, -5);                
            }
        }

        const setGraDep = (labels, data, images, total) => {

            let dep = document.getElementById("chart-departamento").getContext("2d");            

            if (chDep) { chDep.destroy(); }

            chDep = new Chart(dep, {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Votos",
                        weight: 5,
                        borderWidth: 0,
                        borderRadius: 4,
                        backgroundColor: "#20c997",
                        data: data,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout:{
                        padding:{
                            right: 16,
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        labels: {
                            render: 'image',
                            images: images,
                            padding: { top: 10}
                        },                        
                        title: {
                            display: true,
                            padding: { bottom: 50},
                            color: 'black',
                            text: 'DEPARTAMENTO: ' + $("#departamento option:selected").text().trim() +' '+ total
                        },                        
                    },
                    scales: {                       
                        x: {
                            min: 0,
                            max: dataView,
                        } 
                    }
                },
                plugins:[ moveChartDep ]
            });

            const moveScroll = () => {
                const { ctx, canvas, chartArea: {left, right, top, bottom, width, height}} = chDep;

                canvas.addEventListener('click', (event)=>{
                    const rect = canvas.getBoundingClientRect();
                    const x = event.clientX - rect.left;
                    const y = event.clientY - rect.top;

                    if(x >= left - 15 && x <= left + 15 && y >= height / 2 + top - 15 && y <= height / 2 + top + 15 ){
                        chDep.options.scales.x.min = chDep.options.scales.x.min - dataMax;
                        chDep.options.scales.x.max = chDep.options.scales.x.max - dataMax;
                        if(chDep.options.scales.x.min <= 0){
                            chDep.options.scales.x.min = 0;
                            chDep.options.scales.x.max = dataView;
                        }                        
                    }
                    

                    if(x >= right - 15 && x <= right + 15 && y >= height / 2 + top - 15 && y <= height / 2 + top + 15 ){
                        chDep.options.scales.x.min = chDep.options.scales.x.min + dataMax;
                        chDep.options.scales.x.max = chDep.options.scales.x.max + dataMax;
                        if(chDep.options.scales.x.max >= data.length){
                            chDep.options.scales.x.min = data.length - dataMax;
                            chDep.options.scales.x.max = data.length;
                        }
                    }
                    chDep.update();

                });
            }

            chDep.ctx.onclick = moveScroll();

        }

        const setGraPro = (labels, data, images, total) => {

            let pro = document.getElementById("chart-provincia").getContext("2d");            

            if (chPro) {
                chPro.destroy();
            }

            chPro = new Chart(pro, {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Votos",
                        weight: 5,
                        borderWidth: 0,
                        borderRadius: 4,
                        backgroundColor: "#20c997",
                        data: data,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout:{
                        padding:{
                            right: 16,
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        labels: {
                            render: 'image',
                            images: images,
                            padding: { top: 10}
                        },
                        title: {
                            display: true,
                            padding: { bottom: 60},
                            color: 'black',
                            text: 'PROVINCIA: ' + $("#provincia option:selected").text().trim() +' '+ total
                        },
                    },
                    scales: {                        
                        x: {
                            min: 0,
                            max: dataView,
                        }                            
                    }
                },
                plugins:[moveChartPro]
            });

            const moveScroll = () => {
                const { ctx, canvas, chartArea: {left, right, top, bottom, width, height}} = chPro;

                canvas.addEventListener('click', (event)=>{
                    const rect = canvas.getBoundingClientRect();
                    const x = event.clientX - rect.left;
                    const y = event.clientY - rect.top;

                    if(x >= left - 15 && x <= left + 15 && y >= height / 2 + top - 15 && y <= height / 2 + top + 15 ){
                        chPro.options.scales.x.min = chPro.options.scales.x.min - dataMax;
                        chPro.options.scales.x.max = chPro.options.scales.x.max - dataMax;
                        if(chPro.options.scales.x.min <= 0){
                            chPro.options.scales.x.min = 0;
                            chPro.options.scales.x.max = dataView;
                        }                        
                    }
                    

                    if(x >= right - 15 && x <= right + 15 && y >= height / 2 + top - 15 && y <= height / 2 + top + 15 ){
                        chPro.options.scales.x.min = chPro.options.scales.x.min + dataMax;
                        chPro.options.scales.x.max = chPro.options.scales.x.max + dataMax;
                        if(chPro.options.scales.x.max >= data.length){
                            chPro.options.scales.x.min = data.length - dataMax;
                            chPro.options.scales.x.max = data.length;
                        }
                    }
                    chPro.update();

                });
            }

            chPro.ctx.onclick = moveScroll();

        }

        const setGraDis = (labels, data, images, total) => {

            let dis = document.getElementById("chart-distrito").getContext("2d");

            if (chDis) {
                chDis.destroy();
            }

            chDis = new Chart(dis, {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Votos",
                        weight: 5,
                        borderWidth: 0,
                        borderRadius: 4,
                        backgroundColor: "#20c997",
                        data: data,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout:{
                        padding:{
                            right: 16,
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        labels: {
                            render: 'image',
                            images: images,
                            padding: { top: 10 }
                        },
                        title: {
                            display: true,
                            padding: { bottom: 60},
                            color: 'black',
                            text: 'DISTRITO: ' + $("#distrito option:selected").text().trim() +' '+ total
                        },
                    },
                    scales: {                        
                        x: {
                            min: 0,
                            max: dataView,
                        }
                    }
                },
                plugins:[moveChartDis]
            });

            const moveScroll = () => {
                const { ctx, canvas, chartArea: {left, right, top, bottom, width, height}} = chDis;

                canvas.addEventListener('click', (event)=>{
                    const rect = canvas.getBoundingClientRect();
                    const x = event.clientX - rect.left;
                    const y = event.clientY - rect.top;

                    if(x >= left - 15 && x <= left + 15 && y >= height / 2 + top - 15 && y <= height / 2 + top + 15 ){
                        chDis.options.scales.x.min = chDis.options.scales.x.min - dataMax;
                        chDis.options.scales.x.max = chDis.options.scales.x.max - dataMax;
                        if(chDis.options.scales.x.min <= 0){
                            chDis.options.scales.x.min = 0;
                            chDis.options.scales.x.max = dataView;
                        }                        
                    }
                    

                    if(x >= right - 15 && x <= right + 15 && y >= height / 2 + top - 15 && y <= height / 2 + top + 15 ){
                        chDis.options.scales.x.min = chDis.options.scales.x.min + dataMax;
                        chDis.options.scales.x.max = chDis.options.scales.x.max + dataMax;
                        if(chDis.options.scales.x.max >= data.length){
                            chDis.options.scales.x.min = data.length - dataMax;
                            chDis.options.scales.x.max = data.length;
                        }
                    }
                    chDis.update();

                });
            }

            chDis.ctx.onclick = moveScroll();

        }
    </script>
@endsection
