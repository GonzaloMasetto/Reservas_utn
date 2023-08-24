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
                        <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">                                     
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">blog</th>                                    
                                    <th style="color:#fff;">Fecha Inicio</th>
                                    <th style="color:#fff;">Fecha Fin</th>   
                                    <th style="color:#fff;">Acciones</th>                                                                
                              </thead>
                              <tbody>
                            @foreach ($events as $event)
                            <tr>
                                <td style="display: none;">{{ $event->id }}</td>                                
                                <td>{{ $event->event }}</td>
                                <td>{{ $event->blog_id }}</td>
                                <td>{{ $event->start_date }}</td>
                                <td>{{ $event->end_date }}</td>
                                <td>
                                    <form>                                        
                                        @can('editar-event')
                                        <a class="btn btn-info" href="">Ver</a>
                                        @endcan
                                    </form>
                                </td>
                                
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        
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
@endpush