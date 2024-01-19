@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Componentes Tics</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                
            
                        @can('crear-ticComponent')
                        <a class="btn btn-warning" href="{{ route('ticComponents.create') }}">Nuevo</a>
                        @endcan
            
                        <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">                                     
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Contenido</th>                                    
                                    <th style="color:#fff;">Acciones</th>                                                               
                              </thead>
                              <tbody>
                            @foreach ($ticComponents as $ticComponent)
                            <tr>
                                <td style="display: none;">{{ $ticComponent->id }}</td>                                
                                <td>{{ $ticComponent->nombre }}</td>
                                <td>{{ $ticComponent->contenido }}</td>
                                <td>
                                    <form action="{{ route('ticComponents.destroy',$ticComponent->id) }}" method="POST">                                        
                                        @can('editar-ticComponent')
                                        <a class="btn btn-info" href="{{ route('ticComponents.edit',$ticComponent->id) }}">Editar</a>
                                        @endcan

                                        @csrf
                                        @method('DELETE')
                                        @can('borrar-ticComponent')
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
                            {!! $ticComponents->links() !!}
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
