<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use App\Models\Docente;
use App\Models\Docente_materia;
use App\Models\Evento;
use App\Models\Facultad;
use App\Models\Materia;
use App\Models\Periodo;
use App\Models\Persona;
use App\Models\Plan;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Docente_materiaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.docente_materia.index')->only('index');
        $this->middleware('can:admin.docente_materia.create')->only('create','store');
        $this->middleware('can:admin.docente_materia.edit')->only('edit','update');
        $this->middleware('can:admin.docente_materia.destroy')->only('destroy');
    }
    public $var = false;
    public $var_car = null;
    public $var_fac = null;
    public function index()
    {   
        $persona = Persona::where('user_id', auth()->user()->id)->first();
        // $docente = $persona->docente()->get();
        $docente = Docente::where('persona_id',$persona->id)->first();
        // return $docente;
        // return $docente->materias()->get();
        // $docente_materias = $docente->materias()->get();
        // $docente_materias = Docente_materia::all();
        $docente_materias = Docente_materia::where('docente_id', $docente->id)->latest('id')->get();
        // return $docente_materias;
        // docente_id
        // return $docente_materias;
        return view('admin.docente_materia.index', compact('docente_materias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $var=false;
        $facultads = Facultad::pluck('nombre_facultad','id');
        // $facultads = Facultad::all();
        $dias = ['lunes','martes','miercoles','jueves','viernes','sabado'];
        // $periodos = Periodo::all();
        $periodos = Periodo::pluck('codigo','id');
        return view('admin.docente_materia.create', compact('facultads','var','dias','periodos'));
        // $personas = Persona::pluck('ci','id');
        // return view('admin.docentes.create',compact('personas'));
    }

    public function data(Request $request){
        if($request->has('facultad_id')){
            $parent_id = $request->get('facultad_id');
            $data = Carrera::where('facultad_id', $parent_id)->get();
            return ['success'=>true, 'data'=>$data];
        }
    }
    public function carrera($id)
    {
        $cities = DB::table("carreras")
                    ->where("facultad_id",$id)
                    ->pluck('nombre_carrera','id');
        return json_encode($cities);
    }
    public function materia($id)
    {
        $cities = DB::table("materias")
                    ->where("carrera_id",$id)
                    ->pluck('nombre_materia','id');
        return json_encode($cities);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'materia_id' => 'required',
            'facultad_id' => 'required',
            'carrera_id' => 'required',
            'periodo_id' => 'required',
            // 'inicio' => 'required',
            // 'fin'=> 'required',
            'dia1'=> 'required',
            'hora_dia1'=> 'required',
            'dia2'=> 'required',
            'hora_dia2'=> 'required',
            // 'primer_parcial'=> 'required',
            // 'segundo_parcial'=> 'required',
            // 'examen_final'=> 'required',
        ]);
        $persona = Persona::where('user_id', auth()->user()->id)->first();
        $docente = Docente::where('persona_id',$persona->id)->first();

        $docente_materium = Docente_materia::create([
            'materia_id' => $request->materia_id,
            'docente_id' => $docente->id,
            'periodo_id' => $request->periodo_id,

            // 'periodo' => $request->periodo,
            // 'inicio' => $request->inicio,
            // 'fin'=> $request->fin,
            'dia1'=> $request->dia1,
            'hora_dia1'=> $request->hora_dia1,
            'dia2'=> $request->dia2,
            'hora_dia2'=> $request->hora_dia2,
            // 'primer_parcial'=> $request->primer_parcial,
            // 'segundo_parcial'=> $request->segundo_parcial,
            // 'examen_final'=> $request->examen_final,
        ]);
        $periodo = Periodo::where('id',$request->periodo_id)->first();
        // return $periodo;

        //ERROR VER QUE ES
        $fecha_i = new DateTime($periodo->fecha_inicio);
        $fecha_f = new DateTime($periodo->fecha_fin);
        $evento1 = Evento::create([
            'title' => 'Inicio',
            'start' => '2000-01-01 00:00:00',
            'end' => $fecha_i->format('Y-m-d H:i:s'),
            'color' => '#c40233',
            'descripcion' => 'Inicio del Periodo',
            'overlap' => false,
            'rendering' => 'background',
            'id_dicta' => $docente_materium->id
        ]);
        $evento2 = Evento::create([
            'title' => 'Fin',
            'start' => $fecha_f->format('Y-m-d H:i:s'),
            'end' => '2030-01-01 00:00:00',
            'color' => '#c40233',
            'descripcion' => 'Fin del Periodo',
            'overlap' => false,
            'rendering' => 'background',
            'id_dicta' => $docente_materium->id
        ]);
        // $fecha_a = new DateTime($periodo->fecha_fin);
        // $plan1 = Plan::create([
        //     'title' => '1er Parcial',
        //     'descripcion' => 'Estimad@ 1er Parcial',
        //     'start' => $fecha_a->format('Y-m-d'),
        //     'end' => $fecha_a->format('Y-m-d'),
        //     'color' => '#c40233',
        //     'id_dicta' => $docente_materium->id
        // ]);
        // return gettype($periodo->primer_parcial_desde);
        $fecha_1d = new DateTime($periodo->primer_parcial_desde);
        $fecha_1h = new DateTime($periodo->primer_parcial_hasta);
        
        $evento3 = Evento::create([
            'title' => '1er Parcial',
            'start' => $fecha_1d->format('Y-m-d H:i:s'),
            'end' => $fecha_1h->format('Y-m-d H:i:s'),
            'color' => '#00FF00',
            'descripcion' => 'Estimad@ 1er Parcial',
            'rendering' => 'background',
            'id_dicta' => $docente_materium->id
        ]);
        
        $fecha_2d = new DateTime($periodo->segundo_parcial_desde);
        $fecha_2h = new DateTime($periodo->segundo_parcial_hasta);
        
        $evento4 = Evento::create([
            'title' => '2do Parcial',
            'start' => $fecha_2d->format('Y-m-d H:i:s'),
            'end' => $fecha_2h->format('Y-m-d H:i:s'),
            'color' => '#FFFF00',
            'descripcion' => 'Estimad@ 2do Parcial',
            'rendering' => 'background',
            'id_dicta' => $docente_materium->id
        ]);

        $fecha_fd = new DateTime($periodo->examen_final_desde);
        $fecha_fh = new DateTime($periodo->examen_final_hasta);
        
        $evento5 = Evento::create([
            'title' => 'Examen Final',
            'start' => $fecha_fd->format('Y-m-d H:i:s'),
            'end' => $fecha_fh->format('Y-m-d H:i:s'),
            'color' => '#00CED1',
            'descripcion' => 'Estimad@ Examen Final',
            'rendering' => 'background',
            'id_dicta' => $docente_materium->id
        ]);
        // return $evento5;
        // $plan1 = Plan::where('id_dicta',$docente_materium->id);
        // return $plan1;
        // $eventod =  DB::table('eventos')->insert([
        //     [
        //         'title' => 'Inicio',
        //         'start' => '2000-01-01 10:00:00',
        //         'end' => $periodo->fecha_inicio,
        //         'color' => '#c40233',
        //         'descripcion' => 'Reunion con el cliente',
        //         'overlap' => false,
        //         'rendering' => 'background',
        //         'id_dicta' => $docente_materium->id
        //     ],
        //     [
        //         'title' => 'Inicio',
        //         'start' => $periodo->fecha_fin,
        //         'end' => '2050-01-01 11:00:00',
        //         'color' => '#c40233',
        //         'descripcion' => 'Reunion con el cliente',
        //         'overlap' => false,
        //         'rendering' => 'background',
        //         'id_dicta' => $docente_materium->id
        //     ]
        // ]);
        // $eventosPeriodo = Evento::where('id_dicta',$docente_materium->id)->get();
        // return $evento1;
        return redirect()->route('admin.docente_materia.edit', compact('docente_materium'))->with('info','Agregaste Nueva Materia con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Docente_materia  $docente_materia
     * @return \Illuminate\Http\Response
     */
    public function show(Docente_materia $docente_materium)
    {
        return view('admin.docentes.show', compact('docente'));
        return view('admin.docente_materia.show', compact('docente_materium'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Docente_materia  $docente_materia
     * @return \Illuminate\Http\Response
     */
    public function edit(Docente_materia $docente_materium)
    {
        // $personas = Persona::pluck('ci','id');
        // return $docente_materium;
        
        $var=true;
        
        $carreras = Carrera::pluck('nombre_carrera','id');
        $materias = Materia::pluck('nombre_materia','id');
        $facultads = Facultad::pluck('nombre_facultad','id');
        // $periodos = Periodo::all();
        $periodos = Periodo::pluck('codigo','id');


        $materia = Materia::where('id', $docente_materium->materia_id )->first();
        $carrera = Carrera::where('id', $materia->carrera_id)->first();

        $var_car = $carrera->id;
        $var_fac = $carrera->facultad_id;

        // return $var_car;
        // return  compact('carrera','materia','docente_materium', 'facultads');
        return view('admin.docente_materia.edit', compact('var','var_car','var_fac','materias','carreras','docente_materium', 'facultads','periodos'));
        // return view('admin.docente_materia.edit', compact('docente_materia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Docente_materia  $docente_materia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Docente_materia $docente_materium)
    {
        // return compact('request','docente_materium');
        
        $request->validate([
            'materia_id' => 'required',
            'facultad_id' => 'required',
            'carrera_id' => 'required',
            'periodo_id' => 'required',
            'dia1'=> 'required',
            'hora_dia1'=> 'required',
            'dia2'=> 'required',
            'hora_dia2'=> 'required',
        ]);
        $docente_materium->update($request->all());
        $periodo = Periodo::where('id',$request->periodo_id)->first();
        $fecha_i = new DateTime($periodo->fecha_inicio);
        $fecha_f = new DateTime($periodo->fecha_fin);

        
        $ini = DB::table('eventos')
                ->where('id_dicta', $docente_materium->id)
                ->where('title', 'Inicio')
               ->update(['end' => $fecha_i->format('Y-m-d H:i:s')]);
        $fin = DB::table('eventos')
               ->where('id_dicta', $docente_materium->id)
               ->where('title', 'Fin')
              ->update(['start' => $fecha_f->format('Y-m-d H:i:s')]);
        
        $fecha_1d = new DateTime($periodo->primer_parcial_desde);
        $fecha_1h = new DateTime($periodo->primer_parcial_hasta);
        $fecha_2d = new DateTime($periodo->segundo_parcial_desde);
        $fecha_2h = new DateTime($periodo->segundo_parcial_hasta);
        $fecha_fd = new DateTime($periodo->examen_final_desde);
        $fecha_fh = new DateTime($periodo->examen_final_hasta);      
        $primer = DB::table('eventos')
              ->where('id_dicta', $docente_materium->id)
              ->where('title', '1er Parcial')
             ->update(['start' => $fecha_1d->format('Y-m-d H:i:s'),
                        'end' => $fecha_1h->format('Y-m-d H:i:s')]);
        $segundo = DB::table('eventos')
            ->where('id_dicta', $docente_materium->id)
            ->where('title', '2do Parcial')
            ->update(['start' => $fecha_2d->format('Y-m-d H:i:s'),
                        'end' => $fecha_2h->format('Y-m-d H:i:s')]);
        $final = DB::table('eventos')
            ->where('id_dicta', $docente_materium->id)
            ->where('title', 'Examen Final')
            ->update(['start' => $fecha_fd->format('Y-m-d H:i:s'),
                        'end' => $fecha_fh->format('Y-m-d H:i:s')]);
        // $mods = Evento::where('id_dicta',$docente_materium->id)->get();
        // return $mods;
        // $evento1 = Evento::create([
        //     'title' => 'Inicio',
        //     'start' => '2000-01-01 10:00:00',
        //     'end' => $fecha_i->format('Y-m-d H:i:s'),
        //     'color' => '#c40233',
        //     'descripcion' => 'Reunion con el cliente',
        //     'overlap' => false,
        //     'rendering' => 'background',
        //     'id_dicta' => $docente_materium->id
        // ]);
        // $evento2 = Evento::create([
        //     'title' => 'Fin',
        //     'start' => $fecha_f->format('Y-m-d H:i:s'),
        //     'end' => '2030-01-01 00:00:00',
        //     'color' => '#c40233',
        //     'descripcion' => 'Reunion con el cliente',
        //     'overlap' => false,
        //     'rendering' => 'background',
        //     'id_dicta' => $docente_materium->id
        // ]);
        // return $request;
        // $docente->update($request->all());
        return redirect()->route('admin.docente_materia.edit', $docente_materium)->with('info','La Materia que Dicta se actualizo con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Docente_materia  $docente_materia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Docente_materia $docente_materium)
    {   
        $docente_materium->delete();
        return redirect()->route('admin.docente_materia.index')->with('info','La Materia Dictada se elimino con exito');
    }
}
