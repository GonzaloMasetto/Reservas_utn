@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Event</h3>
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


                    <form action="{{ route('blogs.update',$blog->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="titulo">Título</label>
                                   <input type="text" name="titulo" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="start_date">Fecha y Hora de Inicio</label>
                                    <input type="datetime-local" name="start_date" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="end_date">Fecha y Hora de Fin</label>
                                    <input type="datetime-local" name="end_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="titulo">Blog</label>
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
