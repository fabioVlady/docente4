<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Periodo;
use Illuminate\Http\Request;

class PeriodoController extends Controller
{
    
    public function index()
    {
        $periodos = Periodo::all();
        return view('admin.periodos.index', compact('periodos'));
    }

    public function create()
    {
        return view('admin.periodos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required',
            // 'descripcion' => 'required',
            'fecha_entrega_plan' => 'required',
            'primer_parcial_desde' => 'required',
            'primer_parcial_hasta' => 'required',
            'segundo_parcial_desde' => 'required',
            'segundo_parcial_hasta' => 'required',
            'examen_final_desde' => 'required',
            'examen_final_hasta' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required'
        ]);
        // dd($request->all());
        $periodo = Periodo::create($request->all());
        
        return redirect()->route('admin.periodos.edit', compact('periodo'))->with('info','El periodo se creo con exito');
    }

    public function show(Periodo $periodo)
    {
        //
    }

    public function edit(Periodo $periodo, $docente_materia)
    {
        return view('admin.periodos.edit', compact('periodo'));
    }

    public function update(Request $request, Periodo $periodo)
    {
        $request->validate([
            'codigo' => 'required',
            // 'descripcion' => 'required',
            'fecha_entrega_plan' => 'required',
            'primer_parcial_desde' => 'required',
            'primer_parcial_hasta' => 'required',
            'segundo_parcial_desde' => 'required',
            'segundo_parcial_hasta' => 'required',
            'examen_final_desde' => 'required',
            'examen_final_hasta' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required'
        ]);
        $periodo->update($request->all());
        return redirect()->route('admin.periodos.edit', $periodo)->with('info','El Periodo se actualizo con exito');
    }

    public function destroy(Periodo $periodo,$docente_materia)
    {
        $periodo->delete();
        return redirect()->route('admin.periodos.index')->with('info','El Periodo se elimino con exito');
    }
}
