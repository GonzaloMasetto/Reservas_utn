@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Events</h3>
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
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Contenido</th>                                    
                                    <th style="color:#fff;">Fecha Inicio</th>
                                    <th style="color:#fff;">Fecha Fin</th>   
                                    <th style="color:#fff;">Acciones</th>  
                                    <th style="color:#fff;">Estado</th>                                                                 
                              </thead>
                              <tbody>
                            @foreach ($events as $event)
                            <tr>
                                <td style="display: none;">{{ $event->id }}</td>                                
                                <td>{{ $event->event }}</td>
                                <td>{{ $event->contenido }}</td>
                                <td>{{ $event->start_date }}</td>
                                <td>{{ $event->end_date }}</td>
                                <td>
                                    <form action="{{ route('events.destroy',$event->id) }}" method="POST">                                        
                                        @can('editar-event')
                                        <a class="btn btn-info" href="{{ route('events.edit',$event->id) }}">Editar</a>
                                        @endcan

                                        @csrf
                                        @method('DELETE')
                                        @can('borrar-event')
                                        <button type="submit" class="btn btn-danger">Borrar</button>
                                        @endcan
                                    </form>
                                </td>
                                <td>
                                    @if ($event->state_id == 1)
                                        <button type="button" class="btn btn-success" id="openModalBtn">Confirmado</button>
                                    @elseif ($event->state_id == 2)
                                        <button type="button" class="btn btn-warning" id="openModalBtn">En Espera</button>
                                    @elseif ($event->state_id == 3)
                                        <button type="button" class="btn btn-danger" id="openModalBtn">Cancelado</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        
                        <div id="modal" class="modal" style="display: none;">
                            <div class="modal-content">
                                <span class="close" id="closeModalBtn">&times;</span>
                                <form action="{{ route('events.destroy',$event->id) }}" method="POST">                                        
                                       

                                        
                                    <button type="submit" class="btn btn-danger">Borrar</button>      
                                </form>
                                
                            </div>

                        </div>     
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
    const openModalBtn = document.getElementById("openModalBtn");
    const closeModalBtn = document.getElementById("closeModalBtn");
    const modal = document.getElementById("modal");

    openModalBtn.addEventListener("click", () => {
    modal.style.display = "flex";
    });

    closeModalBtn.addEventListener("click", () => {
    modal.style.display = "none";
    });

    window.addEventListener("click", (event) => {
    if (event.target === modal) {
        modal.style.display = "none";
    }
    });

</script>

@endpush