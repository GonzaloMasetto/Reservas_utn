<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Blog;
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
        $blogs = Blog::paginate(5);
        return view('events.crear', compact('blogs'));
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
            'blog_id' => 'required',
            'date' => 'required',
            'start_hour' => 'required',
            'end_hour' => 'required',
        ]);
    
        // Calcula las fechas y horas de inicio y finalización
        $start_date = Carbon::createFromFormat('Y-m-d H:i', $request->date . ' ' . $request->start_hour);
        $end_date = Carbon::createFromFormat('Y-m-d H:i', $request->date . ' ' . $request->end_hour);
    
        // Crea el evento con las fechas y horas calculadas
        Event::create([
            'event' => $request->event,
            'contenido' => $request->contenido,
            'blog_id' => $request->blog_id,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ]);
    
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
            'blog_id' => 'required',
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
    
    
}
