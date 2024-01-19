<?php

namespace App\Http\Controllers;

use App\Models\TypeEvent;
use Illuminate\Http\Request;

class TypeEventController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-typeEvent|crear-typeEvent|editar-typeEvent|borrar-typeEvent')->only('index');
         $this->middleware('permission:crear-typeEvent', ['only' => ['create','store']]);
         $this->middleware('permission:editar-typeEvent', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-typeEvent', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //Con paginación
         $typeEvents = TypeEvent::paginate(5);
         return view('typeEvents.index',compact('typeEvents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('typeEvents.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTypeEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'nombre' => 'required',
            'contenido' => 'required',
        ]);
    
        TypeEvent::create($request->all());
    
        return redirect()->route('typeEvents.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeEvent  $typeEvent
     * @return \Illuminate\Http\Response
     */
    public function show(TypeEvent $typeEvent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeEvent  $typeEvent
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeEvent $typeEvent)
    {
        return view('typeEvents.editar',compact('typeEvent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTypeEventRequest  $request
     * @param  \App\Models\TypeEvent  $typeEvent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeEvent $typeEvent)
    {
        request()->validate([
            'nombre' => 'required',
            'contenido' => 'required',
        ]);
    
        $typeEvent->update($request->all());
    
        return redirect()->route('typeEvents.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeEvent  $typeEvent
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeEvent $typeEvent)
    {
        $typeEvent->delete();
    
        return redirect()->route('typeEvents.index');
    }
}
