<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Place;
use App\Models\Event;

class PlaceController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-place|crear-place|editar-place|borrar-place')->only('index');
         $this->middleware('permission:crear-place', ['only' => ['create','store']]);
         $this->middleware('permission:editar-place', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-place', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
         //Con paginación
         $places = Place::paginate(5);
         return view('places.index',compact('places'));
         //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $places->links() !!}    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('places.crear');
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
            'titulo' => 'required',
            'contenido' => 'required',
            'cant_max' => 'required',
        ]);
    
        Place::create($request->all());
    
        return redirect()->route('places.index');
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
    public function edit(Place $place)
    {
        return view('places.editar',compact('place'));
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Place $place)
    {
         request()->validate([
            'titulo' => 'required',
            'contenido' => 'required',
            'cant_max' => 'required',
        ]);
    
        $place->update($request->all());
    
        return redirect()->route('places.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
        $place->delete();
    
        return redirect()->route('places.index');
    }

    public function calendar(Place $place)
    {
        $all_events = Event::where('place_id', $place->id)->get();

        $events = [];

        foreach ($all_events as $event) {
            
            $events[] = [
                'title' => $event->event,
                'start' => $event->start_date,
                'end' => $event->end_date,

            ];
        }

        return view('places.calendar', compact('events'));
    }

    public function events(Place $place)
    {
        $all_events = Event::where('place_id', $place->id)->get();

        $events = [];

        foreach ($all_events as $event) {
            
            $events[] = [
                'title' => $event->event,
                'start' => $event->start_date,
                'end' => $event->end_date,

            ];
        }

        return response()->json($events);
    }
}
