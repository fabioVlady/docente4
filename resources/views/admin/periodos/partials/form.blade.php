<div class="row">
    <div class="col-3">
        <div class="form-group">
            {!! Form::label('codigo', 'Codigo del Periodo') !!}
            {!! Form::text('codigo', null, ['class' => 'form-control', 'placeholder' => 'Escriba el Codigo']) !!}
            @error('codigo')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            {!! Form::label('fecha_entrega_plan', 'Entrega Plan') !!}
            {!! Form::date('fecha_entrega_plan', null, ['class' => 'form-control', 'placeholder' => 'Fecha de Final Recepcion Plan']) !!}
            @error('fecha_entrega_plan')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {!! Form::label('descripcion', 'Descripcion') !!}
            {!! Form::text('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Escriba la Descripcion']) !!}
            @error('descripcion')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            {!! Form::label('fecha_inicio', 'Fecha Inicio Periodo') !!}
            {!! Form::date('fecha_inicio', null, ['class' => 'form-control', 'placeholder' => 'Fecha de Inicio Periodo']) !!}
            @error('fecha_inicio')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            {!! Form::label('fecha_fin', 'Fecha Fin Periodo') !!}
            {!! Form::date('fecha_fin', null, ['class' => 'form-control', 'placeholder' => 'Fecha Fin Periodo']) !!}
            @error('fecha_fin')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            {!! Form::label('primer_parcial_desde', '1er parcial Desde') !!}
            {!! Form::date('primer_parcial_desde', null, ['class' => 'form-control', 'placeholder' => 'Fecha de Inicio para 1er parcial']) !!}
            @error('primer_parcial_desde')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            {!! Form::label('primer_parcial_hasta', '1er parcial Hasta') !!}
            {!! Form::date('primer_parcial_hasta', null, ['class' => 'form-control', 'placeholder' => 'Fecha de Fin para 1er parcial']) !!}
            @error('primer_parcial_hasta')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group">
            {!! Form::label('segundo_parcial_desde', '2do parcial Desde') !!}
            {!! Form::date('segundo_parcial_desde', null, ['class' => 'form-control', 'placeholder' => 'Fecha de Inicio para 2do parcial']) !!}
            @error('segundo_parcial_desde')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            {!! Form::label('segundo_parcial_hasta', '2do parcial Hasta') !!}
            {!! Form::date('segundo_parcial_hasta', null, ['class' => 'form-control', 'placeholder' => 'Fecha de Fin para 2do parcial']) !!}
            @error('segundo_parcial_hasta')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group">
            {!! Form::label('examen_final_desde', 'Examen Final Desde') !!}
            {!! Form::date('examen_final_desde', null, ['class' => 'form-control', 'placeholder' => 'Fecha de Inicio para Examen Final']) !!}
            @error('examen_final_desde')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            {!! Form::label('examen_final_hasta', 'Examen Final Hasta') !!}
            {!! Form::date('examen_final_hasta', null, ['class' => 'form-control', 'placeholder' => 'Fecha de Fin para Examen Final']) !!}
            @error('examen_final_hasta')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
    </div>
</div>