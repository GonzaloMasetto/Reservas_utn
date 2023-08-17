@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Places</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                
            
                        @can('crear-place')
                        <a class="btn btn-warning" href="{{ route('places.create') }}">Nuevo</a>
                        @endcan
            
                        <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">                                     
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Titulo</th>
                                    <th style="color:#fff;">Contenido</th>                                    
                                    <th style="color:#fff;">Acciones</th>
                                    <th style="color:#fff;">Calendario</th>                                                                   
                              </thead>
                              <tbody>
                            @foreach ($places as $place)
                            <tr>
                                <td style="display: none;">{{ $place->id }}</td>                                
                                <td>{{ $place->titulo }}</td>
                                <td>{{ $place->contenido }}</td>
                                <td>
                                    <form action="{{ route('places.destroy',$place->id) }}" method="POST">                                        
                                        @can('editar-place')
                                        <a class="btn btn-info" href="{{ route('places.edit',$place->id) }}">Editar</a>
                                        @endcan

                                        @csrf
                                        @method('DELETE')
                                        @can('borrar-place')
                                        <button type="submit" class="btn btn-danger">Borrar</button>
                                        @endcan
                                    </form>
                                </td>
                                <td>
                                    <form>                                      
                                        <a class="btn btn-info" href="{{ route('places.calendar', ['place' => $place->id]) }}">Ver Calendario</a>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <!-- Ubicamos la paginacion a la derecha -->
                        <div class="pagination justify-content-end">
                            {!! $places->links() !!}
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
