@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Crear Evento</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">     
                                                                      
                        @if ($errors->any())                                                
                            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                            <strong>¡Revise los campos!</strong>                        
                                @foreach ($errors->all() as $error)                                    
                                    <span class="badge badge-danger">{{ $error }}</span>
                                @endforeach                        
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        @endif

                    <form action="{{ route('events.store') }}" method="POST" id="event-form">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="event">Event</label>
                                        <input type="text" name="event" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="place_id">Place</label>
                                        <select name="place_id" class="form-control" id="miSelect">
                                            <option value="">Seleccione un place</option>
                                            @foreach ($places as $place)
                                                <option value="{{ $place->id }}">{{ $place->titulo }}</option>
                                            @endforeach
                                        </select>
                                        <div id="event_list">
                                            <!-- Aquí se mostrarán los eventos -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12" id="date-time-section" style="display: none;">
                                <div class="form-group">
                                    <label for="typeEvent_id">Tipo de Evento</label>
                                    <select name="typeEvent_id" class="form-control" id="miSelect">
                                        <option value="">Seleccione un Tipo de Evento</option>
                                        @foreach ($typeEvents as $typeEvent)
                                            <option value="{{ $typeEvent->id }}">{{ $typeEvent->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <div id="event_list">
                                        <!-- Aquí se mostrarán los eventos -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="otro">Si selecciono Otro, ingrese aquí las especificaciones</label>
                                    <input type="text" class="form-control" name="otro" id="otro" placeholder="Ingrese otro valor">
                                </div>  
                                <div class="form-group">
                                    <label for="cant_personas">Cantidad de Personas</label>
                                    <select name="cant_personas" class="form-control" id="miSelect">
                                        <option value="">Seleccione Cantidad de Personas</option>
                                        @for ($i = 1; $i <= $place->cant_max; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <div id="event_list">
                                        <!-- Aquí se mostrarán los eventos -->
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="selected_date">Selecciona un día:</label>
                                    <input type="datetime-local" id="selected_date" class="form-control" name="date">
                                </div>
                                <div class="form-group">
                                    <label for="available_hours">Horas Inicio</label>
                                    <select id="available_hours" class="form-control" name="start_hour">
                                        <!-- Las opciones de horas disponibles se generarán aquí mediante JavaScript -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="horaFin">Horas Fin</label>
                                    <select id="horaFin" class="form-control" name="end_hour">
                                        <!-- Las opciones de horas disponibles se generarán aquí mediante JavaScript -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Desea Pedir Componentes Tic?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="opcionTic" value="si" id="reservaSi">
                                        <label class="form-check-label" for="reservaSi">
                                            SI
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="opcionTic" value="no" id="reservaNo">
                                        <label class="form-check-label" for="reservaNo">
                                            NO
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group" id="opcionesComponentes" style="display: none;">
                                    <div class="componente">
                                        
                                    </div>
                                </div>

                                <div id="agregarComponente" style="display: none;">
                                    <button type="button" id="botonAgregarComponente" class="btn btn-primary">
                                        Agregar otro componente <i class="fa fa-plus-circle"></i>
                                    </button>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="hidden" name="video_conferencia" value="0">
                                        <input class="form-check-input" type="checkbox" name="video_conferencia" id="video_conferencia" value="1">
                                        <label class="form-check-label" for="video_conferencia">
                                            Video Conferencia
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input type="hidden" name="difusion_redes" value="0">
                                        <input class="form-check-input" type="checkbox" name="difusion_redes" id="difusion_redes" value="1">
                                        <label class="form-check-label" for="difusion_redes">
                                            Difusion en las Redes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input type="hidden" name="transmision_youtube" value="0">
                                        <input class="form-check-input" type="checkbox" name="transmision_youtube" id="transmision_youtube" value="1">
                                        <label class="form-check-label" for="transmision_youtube">
                                            Transmision en Youtube y Redes Sociales
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input type="hidden" name="catering" value="0">
                                        <input class="form-check-input" type="checkbox" name="catering" id="catering" value="1">
                                        <label class="form-check-label" for="catering">
                                            Catering
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="adicional">Si desea Catering especificar aca todo lo que necesita</label>
                                    <input type="text" class="form-control" name="adicional" id="adicional" placeholder="Ingrese los datos del catering">
                                </div> 
                    
                                <div class="form-floating">
                                <label for="contenido">Contenido</label>
                                <textarea class="form-control" name="contenido" style="height: 100px" id="aca"></textarea>
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12">

                                
                                <button type="submit" class="btn btn-primary my-2">Guardar</button>                            
                        </div>
                    </form>
                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
    const reservaSi = document.getElementById('reservaSi');
    const reservaNo = document.getElementById('reservaNo');
    const opcionesComponentes = document.getElementById('opcionesComponentes');
    const botonAgregarComponente = document.getElementById('botonAgregarComponente');
    const agregarComponente = document.getElementById('agregarComponente');

    // Agrega el primer componente
    agregarNuevoComponente();
    
    botonAgregarComponente.addEventListener('click', function() {
        agregarNuevoComponente();
    });
    
    function agregarNuevoComponente() {
        const componenteDiv = document.createElement('div');
        componenteDiv.className = 'componente';
        componenteDiv.innerHTML = `
            <div class="d-flex align-items-center mb-2">
                <select name="ticComponent_id[]" class="form-control componentesSelect">
                    <option value="">Seleccione componente de Tic</option>
                    @foreach ($ticComponents as $ticComponent)
                        <option value="{{ $ticComponent->id }}">{{ $ticComponent->nombre }}</option>
                    @endforeach
                </select>
                <label for="cantidad" class="ml-4 mr-2">Cantidad:</label>
                <select name="cantidad[]" class="form-control cantidadSelect" disabled>
                    <option value="">Seleccione cantidad</option>
                </select>
                <button type="button" class="btn btn-danger ml-2 eliminarComponente">
                    <i class="fa fa-trash"></i>
                </button>
            </div>
        `;
        opcionesComponentes.appendChild(componenteDiv);
        addEliminarEventListener(componenteDiv);

        const componentesSelect = componenteDiv.querySelector('.componentesSelect');
        const cantidadSelect = componenteDiv.querySelector('.cantidadSelect');

        componentesSelect.addEventListener('change', function() {
            const selectedComponent = this.value;
            if (selectedComponent) {
                const maxCantidad = obtenerMaxCantidad(selectedComponent);
                cantidadSelect.innerHTML = '';
                for (let i = 1; i <= maxCantidad; i++) {
                    cantidadSelect.innerHTML += `<option value="${i}">${i}</option>`;
                }
                cantidadSelect.removeAttribute('disabled');
            } else {
                cantidadSelect.innerHTML = '<option value="">Seleccione cantidad</option>';
                cantidadSelect.setAttribute('disabled', 'disabled');
            }
        });
    }
    
    function addEliminarEventListener(componenteDiv) {
        const eliminarBoton = componenteDiv.querySelector('.eliminarComponente');
        eliminarBoton.addEventListener('click', function() {
            opcionesComponentes.removeChild(componenteDiv);
        });
    }

    function obtenerMaxCantidad(componenteId) {
        // Aquí debes proporcionar la lógica para obtener la cantidad máxima del componente desde Laravel
        // Puedes hacer una consulta a tu base de datos u otra fuente de datos.
        // Por ahora, se devolverá un valor fijo.
        return 10;
    }
        
        reservaSi.addEventListener('change', function() {
            if (reservaSi.checked) {
                opcionesComponentes.style.display = 'block';
                reservaNo.checked = false;
                agregarComponente.style.display = 'block';
            }
        });

        reservaNo.addEventListener('change', function() {
            if (reservaNo.checked) {
                opcionesComponentes.style.display = 'none';
                reservaSi.checked = false;
                agregarComponente.style.display = 'none';
            }
        });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const placeSelect = document.getElementById("miSelect");
        const dateTimeSection = document.getElementById("date-time-section");

        placeSelect.addEventListener("change", function () {
            if (placeSelect.value !== "") {
                dateTimeSection.style.display = "block";
            } else {
                dateTimeSection.style.display = "none";
            }
        });
    });
    </script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        var miSelect = document.getElementById("miSelect");
        
        miSelect.addEventListener("change", function() {
            var selectedPlaceId = miSelect.value;
            var url = "{{ route('places.events', ['place' => ':placeId']) }}";
            url = url.replace(':placeId', selectedPlaceId);
            
            // Realizar una solicitud AJAX para obtener los eventos
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    //llamamos al desahabilitador de dias del calendario
                    procesarEventos(data);
                })
                .catch(error => {
                    console.error('Error al obtener los eventos:', error);
                });
        });
        
        // Función para separar eventos por fechas y aplicar deshabilitación en flatpickr
        function procesarEventos(eventos) {
                        // Objeto para almacenar la suma de horas por fecha
            const sumaHorasPorFecha = {};
            const fechasDeshabilitadas = [];
            // Calcular la suma de horas por fecha
            eventos.forEach(evento => {
            const fecha = evento.start.split(' ')[0];
            const duracionEvento = new Date(evento.end) - new Date(evento.start);
            const duracionEnHoras = duracionEvento / (1000 * 60 * 60); // Convertir a horas
            

            if (!sumaHorasPorFecha[fecha]) {
                sumaHorasPorFecha[fecha] = 0;
            }
            sumaHorasPorFecha[fecha] += duracionEnHoras;
            });

            // Imprimir la suma de horas por fecha
            for (const fecha in sumaHorasPorFecha) {
                if (sumaHorasPorFecha[fecha] === 4) {

                    fechasDeshabilitadas.push(fecha);
                }
                //escribime aca lo siguiente if(${sumaHorasPorFecha[fecha]} == 4){

                //}
                console.log(`Suma de horas para la fecha ${fecha}: ${sumaHorasPorFecha[fecha]} horas`);
                console.log(fechasDeshabilitadas);
            }
            // Deshabilitar el día aquí
                   
           // Configurar Flatpickr con las fechas deshabilitadas
            flatpickr("input[type=datetime-local]", {
                disable: [...fechasDeshabilitadas, function(date) {
                    // return true to disable
                    return (date.getDay() === 0 || date.getDay() === 6);
                }]
            });
        }

        const eventosPorFecha = procesarEventos(eventos);
        console.log(eventosPorFecha);

    });
        const availableHours = [
            // Aquí puedes definir las horas disponibles para cada día de la semana
            { dayOfWeek: 0, hours: ['08:00', '09:00', '10:00', '11:00', '12:00'] }, // Domingo
            { dayOfWeek: 1, hours: ['08:00', '09:00', '10:00', '11:00', '12:00'] }, // Lunes
            { dayOfWeek: 2, hours: ['08:00', '09:00', '10:00', '11:00', '12:00'] }, // Martes
            { dayOfWeek: 3, hours: ['08:00', '09:00', '10:00', '11:00', '12:00'] }, // Miércoles
            { dayOfWeek: 4, hours: ['08:00', '09:00', '10:00', '11:00', '12:00'] }, // Jueves
            { dayOfWeek: 5, hours: ['08:00', '09:00', '10:00', '11:00', '12:00'] }, // Viernes
            { dayOfWeek: 6, hours: ['08:00', '09:00', '10:00', '11:00', '12:00'] }  // Sábado
        ];

        const selectedDateInput = document.getElementById('selected_date');
        const availableHoursSelect = document.getElementById('available_hours');
        const horaFin = document.getElementById('horaFin');

        selectedDateInput.addEventListener('change', updateAvailableHours);

        function updateAvailableHours() {
            const selectedDate = new Date(selectedDateInput.value);
            const dayOfWeek = selectedDate.getDay();
            const hours = availableHours.find(item => item.dayOfWeek === dayOfWeek).hours;
            populateSelectWithHours(hours);
        }

        function populateSelectWithHours(hours) {
            availableHoursSelect.innerHTML = '';

            if (hours.length === 0) {
                availableHoursSelect.innerHTML = '<option value="">No hay horas disponibles</option>';
                return;
            }

            hours.forEach(hour => {
                const option = document.createElement('option');
                option.value = hour;
                option.textContent = hour;
                availableHoursSelect.appendChild(option);
            });

            horaFin.innerHTML = '';

            if (hours.length === 0) {
                horaFin.innerHTML = '<option value="">No hay horas disponibles</option>';
                return;
            }

            hours.forEach(hour => {
                const option = document.createElement('option');
                option.value = hour;
                option.textContent = hour;
                horaFin.appendChild(option);
            });
        }
    </script>
@endpush