<?php

namespace App\Http\Controllers;

use App\Models\TicComponent;
use Illuminate\Http\Request;

class TicComponentController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-ticComponent|crear-ticComponent|editar-ticComponent|borrar-ticComponent')->only('index');
         $this->middleware('permission:crear-ticComponent', ['only' => ['create','store']]);
         $this->middleware('permission:editar-ticComponent', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-ticComponent', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Con paginación
         $ticComponents = TicComponent::paginate(5);
         return view('ticComponents.index',compact('ticComponents'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        return view('ticComponents.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTicComponentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'nombre' => 'required',
            'contenido' => 'required',
            'stock' => 'required',
        ]);
    
        TicComponent::create($request->all());
    
        return redirect()->route('ticComponents.index');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TicComponent  $ticComponent
     * @return \Illuminate\Http\Response
     */
    public function show(TicComponent $ticComponent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TicComponent  $ticComponent
     * @return \Illuminate\Http\Response
     */
    public function edit(TicComponent $ticComponent)
    {
        return view('ticComponents.editar',compact('ticComponent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTicComponentRequest  $request
     * @param  \App\Models\TicComponent  $ticComponent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TicComponent $ticComponent)
    {
        request()->validate([
            'nombre' => 'required',
            'contenido' => 'required',
            'stock' => 'required',
        ]);
    
        $ticComponent->update($request->all());
    
        return redirect()->route('ticComponents.index');
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TicComponent  $ticComponent
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicComponent $ticComponent)
    {
        $ticComponent->delete();
    
        return redirect()->route('ticComponents.index');
    }
}
