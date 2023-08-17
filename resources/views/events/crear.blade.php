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
                                <div class="form-group">
                                   <label for="event">Event</label>
                                   <input type="text" name="event" class="form-control">
                                </div>
                                <div class="form-group">
                                   <label for="event">Nombre y Apellido</label>
                                   <input type="text" name="event" class="form-control">
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
                            <div id="date-time-section" style="display: none;">
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
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                    
                                <div class="form-floating">
                                <label for="contenido">Contenido</label>
                                <textarea class="form-control" name="contenido" style="height: 100px" id="aca"></textarea>
                                </div>
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