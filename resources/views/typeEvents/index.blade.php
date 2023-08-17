@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">TypeEvents</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                
            
                        @can('crear-typeEvent')
                        <a class="btn btn-warning" href="{{ route('typeEvents.create') }}">Nuevo</a>
                        @endcan
            
                        <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">                                     
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Contenido</th>                                    
                                    <th style="color:#fff;">Acciones</th>                                                               
                              </thead>
                              <tbody>
                            @foreach ($typeEvents as $typeEvent)
                            <tr>
                                <td style="display: none;">{{ $typeEvent->id }}</td>                                
                                <td>{{ $typeEvent->nombre }}</td>
                                <td>{{ $typeEvent->contenido }}</td>
                                <td>
                                    <form action="{{ route('typeEvents.destroy',$typeEvent->id) }}" method="POST">                                        
                                        @can('editar-typeEvent')
                                        <a class="btn btn-info" href="{{ route('typeEvents.edit',$typeEvent->id) }}">Editar</a>
                                        @endcan

                                        @csrf
                                        @method('DELETE')
                                        @can('borrar-typeEvent')
                                        <button type="submit" class="btn btn-danger">Borrar</button>
                                        @endcan
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <!-- Ubicamos la paginacion a la derecha -->
                        <div class="pagination justify-content-end">
                            {!! $typeEvents->links() !!}
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
