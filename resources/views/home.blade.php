@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Bienvenido al Sistema de Pedidos de Salones de la UTN- FRM</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">                          
                                <div class="row">
                                    @php
                                        use App\Models\User;
                                        $cant_usuarios = User::count();                                                
                                    @endphp
                                    @can('ver-usuario')           
                                        <div class="col-md-4 col-xl-4">
                                        <div class="card bg-c-blue order-card-blue">
                                                <div class="card-block">
                                                <h5>Usuarios</h5>                                               
                                                    
                                                    <h2 class="text-right"><i class="fa fa-users f-left"></i><span>{{$cant_usuarios}}</span></h2>
                                                    <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver más</a></p>
                                                </div>                                            
                                            </div>                                    
                                        </div>
                                    @endcan
                                    @php
                                        use App\Models\Event;
                                        $cant_events_confirmados = Event::where('state_id', 1)->count();
                                    @endphp
                                    @can('ver-eventconfirmados')
                                        <div class="col-md-4 col-xl-4">
                                            <div class="card bg-c-black order-card-black">
                                                <div class="card-block">
                                                    <h5>Eventos Confirmados</h5>
                                                    <h2 class="text-right"><i class="fa fa-place f-left"></i><span>{{ $cant_events_confirmados }}</span></h2>
                                                    <p class="m-b-0 text-right"><a href="/events/confirmados" class="text-white">Ver más</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    @endcan
                                    @php
                                        use App\Models\Place;
                                        $cant_places = Place::count();                                                
                                    @endphp
                                    @can('ver-place')
                                    <div class="col-md-4 col-xl-4">
                                        <div class="card bg-c-blue order-card-blue">
                                            <div class="card-block">
                                                <h5>Lugares</h5>                                               
                                                <h2 class="text-right"><i class="fa fa-place f-left"></i><span>{{$cant_places}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="/places" class="text-white">Ver más</a></p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    @endcan
                                    @php
                                        $cant_events = Event::count();                                                
                                        @endphp
                                    @can('ver-event')
                                    <div class="col-md-4 col-xl-4">
                                        <div class="card bg-c-black order-card-black" onclick="window.location.href='/events'">
                                            <div class="card-block">
                                                <h5>Pedidos</h5>                                                       
                                                <h2 class="text-right"><i class="fa fa-place f-left"></i><span>{{$cant_events}}</span></h2>
                                                    <p class="m-b-0 text-right"><a href="/events" class="text-white">Ver más</a></p>
                                                </div>
                                        </div>
                                    </div>
                                    @endcan
                                    @php
                                        use App\Models\TypeEvent;
                                        $cant_type_events = TypeEvent::count();                                                
                                    @endphp
                                    @can('ver-typeEvent')
                                    <div class="col-md-4 col-xl-4">
                                        <div class="card bg-c-blue order-card-blue">
                                            <div class="card-block">
                                                <h5>Tipo de Eventos</h5>                                             
                                                <h2 class="text-right"><i class="fa fa-place f-left"></i><span>{{$cant_type_events}}</span></h2>
                                                    <p class="m-b-0 text-right"><a href="/events" class="text-white">Ver más</a></p>                                                
                                                </div>
                                        </div>
                                    </div>
                                    @endcan
                                    @php
                                        use App\Models\TicComponent;
                                        $cant_componente_tics = TicComponent::count();                                                
                                    @endphp
                                    @can('ver-ticComponent')
                                    <div class="col-md-4 col-xl-4">
                                        <div class="card bg-c-black order-card-black">
                                            <div class="card-block">
                                                <h5>Componentes Tecnologicos</h5>                       
                                                <h2 class="text-right"><i class="fa fa-place f-left"></i><span>{{$cant_componente_tics}}</span></h2>
                                                    <p class="m-b-0 text-right"><a href="/events" class="text-white">Ver más</a></p>                                                
                                                </div>
                                        </div>
                                    </div>
                                    @endcan
                                </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

