<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Place;
use App\Models\TicComponent;
use App\Models\TypeEvent;
use Carbon\Carbon;


class EventController extends Controller
{
    
    function __construct()
    {
         $this->middleware('permission:ver-event|crear-event|editar-event|borrar-event')->only('index');
         $this->middleware('permission:crear-event', ['only' => ['create','store']]);
         $this->middleware('permission:editar-event', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-event', ['only' => ['destroy']]);
    }
    public function index()
    {
        $events = Event::paginate(5);
        return view('events.index',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $places = Place::paginate(5);
        $typeEvents = TypeEvent::paginate(5);
        $ticComponents = TicComponent::paginate(5);
        return view('events.crear', compact('places', 'typeEvents','ticComponents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'event' => 'required',
            'contenido' => 'required',
            'place_id' => 'required',
            'date' => 'required',
            'start_hour' => 'required',
            'end_hour' => 'required',
            'typeEvent_id' => 'required',
            'cant_personas' => 'required',
            
        ]);
    
        // Calcula las fechas y horas de inicio y finalización
        $start_date = Carbon::createFromFormat('Y-m-d H:i', $request->date . ' ' . $request->start_hour);
        $end_date = Carbon::createFromFormat('Y-m-d H:i', $request->date . ' ' . $request->end_hour);
    
        // Crea el evento con las fechas y horas calculadas
        $event = Event::create([
            'event' => $request->event,
            'contenido' => $request->contenido,
            'place_id' => $request->place_id,
            'type_event_id' => $request->typeEvent_id,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'cant_personas' => $request->cant_personas, 
            'video_conferencia' => $request->video_conferencia,
            'difusion_redes' => $request->difusion_redes,
            'transmision_youtube' => $request->transmision_youtube,
            'catering' => $request->catering,
            'otro' => $request->otro,
            'adicional' => $request->adicional,
            'state_id' => 2,
        ]);

        if ($request->opcionTic === 'si' && $request->has('ticComponent_id')) {
            $ticComponents = $request->input('ticComponent_id');
            $cantidades = $request->input('cantidad'); // Obtener las cantidades

            foreach ($ticComponents as $index => $ticComponentId) {
                $cantidad = $cantidades[$index];
                $event->ticComponents()->attach($ticComponentId, ['cantidad' => $cantidad]);
            }
        }
            
        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('events.editar',compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'event' => 'required',
            'contenido' => 'required',
            'place_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
    
        $event->update($request->all());
    
        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();
    
        return redirect()->route('events.index');
    }
    public function updateState(Request $request)
    {
        $event = Evento::find($request->event_id);      
        // Actualiza el estado del evento aquí
        $event->update(['state_id' => $request->nuevo_estado]);

        // Resto del código necesario

        return view('tu_vista', compact('estadosFaltantes'));
    }
    public function getMissingStates(Evento $event)
    {
        $estadosFaltantes = Estado::where('id', '!=', $event->state_id)->get();
        
        return response()->json(['estadosFaltantes' => $estadosFaltantes]);
    }


    
}
