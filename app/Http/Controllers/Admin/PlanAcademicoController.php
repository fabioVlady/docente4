<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Docente_materia;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanAcademicoController extends Controller
{
    public function index(Plan $plan)
    {
        return $plan;
        $plans = Plan::all();
        return view('admin.plans.index', compact('plans'));
    }

    public function create(Docente_materia $docente_materia)
    {
        // return $docente_materia;
        return view('admin.plans.create', compact('docente_materia'));
    }

    public function store(Request $request, Docente_materia $docente_materia)
    {
        $request->validate([
            'title' => 'required',
            // 'descripcion' => 'required',
            'color' => 'required',
            'start' => 'required',
            'end' => 'required',
            'descripcion' => 'required',
            'id_dicta' => 'required'
        ]);
        // return $request;
        // dd($request->all());
        $plan = Plan::create($request->all());
        
        return redirect()->route('admin.plans.edit', compact('plan','docente_materia'))->with('info','El Tema se agrego con exito');
    }

    public function show(Plan $plan)
    {
        //
    }

    public function edit(Docente_materia $docente_materia,Plan $plan)
    {   
        // return $plan;

        return view('admin.plans.edit', compact('plan','docente_materia'));
    }

    public function update(Request $request,Docente_materia $docente_materia,Plan $plan)
    {
        $request->validate([
            'title' => 'required',
            // 'descripcion' => 'required',
            'color' => 'required',
            'start' => 'required',
            'end' => 'required',
            'descripcion' => 'required',
            'id_dicta' => 'required'
        ]);
        // return $request;
        $plan->update($request->all());
        return redirect()->route('admin.plans.edit', [$docente_materia,$plan])->with('info','El Tema se actualizo con exito');
    }

    public function destroy(Docente_materia $docente_materia,Plan $plan)
    {
        $plan->delete();
        return redirect()->route('admin.plans.index',[$docente_materia])->with('info','El tema se elimino con exito');
    }
}
