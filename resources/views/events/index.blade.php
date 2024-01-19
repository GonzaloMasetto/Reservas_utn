@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Pedidos</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                
            
                        @can('crear-event')
                        <a class="btn btn-warning" href="{{ route('events.create') }}">Nuevo</a>
                        @endcan
            
                        <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">                                     
                                    <th style="color:#fff;">Evento</th>
                                    <th style="color:#fff;">Lugar</th>
                                    <th style="color:#fff;">Fecha de Inicio</th>
                                    <th style="color:#fff;">Fecha de Fin</th>
                                    <th style="color:#fff;">Acciones</th>  
                                    <th style="color:#fff;">Estado</th>                                                                 
                              </thead>
                              <tbody>
                            @foreach ($events as $event)
                            <tr>
                                <td style="display: none;">{{ $event->id }}</td>                                
                                <td>{{ $event->event }}</td>
                                <td>{{ $event->place->titulo }}</td>
                                <td>{{ $event->start_date }}</td>
                                <td>{{ $event->end_date }}</td>
                                <td>
                                    
                                @if(auth()->user()->hasRole('alumno'))
                                    <form action="{{ route('events.destroy', $event->id) }}" method="POST">                                        
                                        @can('editar-event')
                                            <a class="btn btn-info" href="{{ route('events.edit', $event->id) }}">Editar</a>
                                        @endcan

                                        @csrf
                                        @method('DELETE')
                                        @can('borrar-event')
                                            <button type="submit" class="btn btn-danger">Borrar</button>
                                        @endcan
                                    </form>
                                @else
                                    <button class="btn btn-primary">Ver</button>
                                @endif
                                </td>
                                <td>
                                    @if (Auth::user()->hasRole('alumno'))
                                        @if ($event->state_id == 1)
                                            <button type="button" class="btn btn-success custom-disabled-btn" disabled>Confirmado</button>
                                        @elseif ($event->state_id == 2)
                                            <button type="button" class="btn btn-warning custom-disabled-btn" disabled>En Espera</button>
                                        @elseif ($event->state_id == 3)
                                            <button type="button" class="btn btn-danger custom-disabled-btn" disabled>Cancelado</button>
                                        @endif
                                    @else
                                        @if ($event->state_id == 1)
                                            <button type="button" class="btn btn-success open-modal-btn" data-state-id="1" data-event-id="{{ $event->id }}">Confirmado</button>
                                        @elseif ($event->state_id == 2)
                                            <button type="button" class="btn btn-warning open-modal-btn" data-state-id="2" data-event-id="{{ $event->id }}">En Espera</button>
                                        @elseif ($event->state_id == 3)
                                            <button type="button" class="btn btn-danger open-modal-btn" data-state-id="3" data-event-id="{{ $event->id }}">Cancelado</button>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        
                        <!-- Agrega el modal -->
                        <div id="modal" class="modal" style="display: none;">
                            <div class="modal-content">
                                <div class="form-group">
                                    <span class="close" id="closeModalBtn">&times;</span>
                                    <h2>Desea cambiar el estado de este pedido?</h2> <!-- Título agregado -->
                                    <p>Selecciona el estado que deseas:</p> <!-- Subtítulo agregado -->
                                    <form action="{{ route('events.updatestate', ['event' => 'EVENT_ID_PLACEHOLDER']) }}" method="POST" id="formState">
                                    @csrf
                                    @method('PUT')
                                        <select  name="state_id" id="newStateSelect"  class="form-control"></select>

                                        <button type="submit" class="btn btn-primary my-3">Cambiar Estado</button> <!-- Texto del botón modificado -->
                                    </form> 
                                </div>
                            </div>
                        </div>   
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <!-- Ubicamos la paginacion a la derecha -->
                        <div class="pagination justify-content-end">
                            {!! $events->links() !!}
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
<!-- Agrega esta línea en el head de tu página para incluir los estilos de Bootstrap -->
<link rel="stylesheet" type="text/css" href="/css/event/index.css">
<!-- Agrega esta línea al final del body de tu página para incluir jQuery y los scripts de Bootstrap -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const openModalBtns = document.querySelectorAll(".open-modal-btn");
        const newStateSelect = document.getElementById("newStateSelect");
        const form = document.getElementById("formState"); // Agregamos esta línea

        openModalBtns.forEach(btn => {
            btn.addEventListener("click", function() {
                const stateId = this.getAttribute("data-state-id");
                const eventId = this.getAttribute("data-event-id");
                newStateSelect.innerHTML = ""; // Limpiamos las opciones existentes

                // Agregamos las opciones según el botón clicado
                if (stateId === "1") {
                    newStateSelect.innerHTML = `
                        <option value="3">Cancelado</option>
                    `;
                } else if (stateId === "2") {
                    newStateSelect.innerHTML = `
                        <option value="1">Confirmado</option>
                        <option value="3">Cancelado</option>
                    `;
                } else if (stateId === "3") {
                    newStateSelect.innerHTML = `
                        <option value="1">Confirmado</option>       
                    `;
                }

                // Actualizamos la URL del formulario con el ID del evento
                form.action = form.action.replace('EVENT_ID_PLACEHOLDER', eventId);

                // Mostramos el modal
                const modal = document.getElementById("modal");
                modal.style.display = "flex";
            });
        });

        const closeModalBtn = document.getElementById("closeModalBtn");
        closeModalBtn.addEventListener("click", function() {
            const modal = document.getElementById("modal");
            modal.style.display = "none";
        });
    });
</script>


@endpush