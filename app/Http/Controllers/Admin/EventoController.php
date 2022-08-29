<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventoRequest;
use App\Models\Docente_materia;
use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Plan;
use Illuminate\Support\Facades\DB;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fastEvents = Plan::all();
        // dd($fastEvents);
        return view('admin.eventos.index', ['fastEvents' => $fastEvents]);
    }


    public function load(Docente_materia $docente_materia){
        $events = Evento::all();
        // $events = Evento::where('id_dicta',$docente_materia->id)->get();  //PARA LOS CASOS DE BUSCAR POR UN CAMPO ESPECIFICO

        // $events = Event::where('id',3)->get();  PARA LOS CASOS DE BUSCAR POR UN CAMPO ESPECIFICO
        return response()->json($events);
    }

    public function store(EventoRequest $request){
        Evento::create($request->all());
        return response()->json(true);
    }
    public function edit(Docente_materia $docente_materia)
    {
        // $request = DB::table('plans')
        // ->where('id',$persona->user_id)
        // ->update([ 
        //     'name' => $request->get('nombres') . ' ' . $request->get('paterno') . ' ' . $request->get('materno'),
        //     'email' => $request->get('email'),
        //     'password' =>bcrypt($request->get('ci'))
        // ]);
        // dd($docente_materia);
        $total = DB::select("select * from plans where id_dicta = $docente_materia->id");
        $plansEnEventos = DB::select("select distinct e.title from eventos e
                                where  exists (select 1 from plans p 
                                            where p.id_dicta = $docente_materia->id
                                            and e.id_dicta = p.id_dicta)
                                and e.deleted_at is null");
        // return count($total);
        if (count($total) == 0) {
            $div = 1;
            $avance = 0;
        }else{
            $div = count($total);
            $avance = ((count($plansEnEventos)-5 )* 100)/$div;
            $avance = round($avance,2); 
        }                              
        // return $avance;
        // dd($avance);
                                            // return $results2;
        // $events = Evento::where('id_dicta',$docente_materia->id)->get();  //PARA LOS CASOS DE BUSCAR POR UN CAMPO ESPECIFICO
        
        $fastEvents = Plan::where('id_dicta',$docente_materia->id)->get();
        
        // dd($fastEvents);
        // return view('admin.eventos.index', ['fastEvents' => $fastEvents]);
        return view('admin.eventos.index', compact('fastEvents','avance','plansEnEventos','total'));

        // return view('admin.eventos.index', compact('docente_materia'));
        
    }

    public function update(EventoRequest $request){
        // var_dump($request->all());
        $event = Evento::where('id',$request->id)->first();
        $event->fill($request->all());
        $event->save();

        return response()->json(true);
    }
    public function destroy(Request $request)
    {
        Evento::where('id', $request->id)->delete();

        return response()->json(true);
    } 
}
