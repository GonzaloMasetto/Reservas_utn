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

                    <form action="{{ route('events.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="event">Event</label>
                                   <input type="text" name="event" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="start_date">Fecha y Hora de Inicio</label>
                                    <input name="start_date" class="form-control" value="2023-9-17 11:00">
                                </div>

                                <div class="form-group">
                                    <label for="end_date">Fecha y Hora de Fin</label>
                                    <input name="end_date" class="form-control" value="2023-9-17 12:00">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="blog_id">Blog</label>
                                    <select name="blog_id" class="form-control">
                                        <option value="">Seleccione un blog</option>
                                        @foreach ($blogs as $blog)
                                            <option value="{{ $blog->id }}">{{ $blog->titulo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                    
                                <div class="form-floating">
                                <textarea class="form-control" name="contenido" style="height: 100px"></textarea>
                                <label for="contenido">Contenido</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar</button>                            
                        </div>
                    </form>
                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
