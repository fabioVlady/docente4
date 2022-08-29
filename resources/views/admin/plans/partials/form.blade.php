<div class="row">
    <div class="col-5">
        <div class="form-group">
            {!! Form::label('title', 'Titulo del Tema') !!}
            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Escriba el Titulo']) !!}
            @error('title')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            {!! Form::label('color', 'Entrega Plan') !!}
            {{-- {!! Form::date('color', null, ['class' => 'form-control', 'placeholder' => 'Fecha de Final Recepcion Plan']) !!} --}}
            {!! Form::select('color', array('#1d1c96' => 'Tema','#1C4C96' => 'Sub Temea'), null, ['class'=>'form-control','placeholder'=>'Elegir Tipo'])!!}
            @error('color')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
    </div>
    <div class="col-2">
        <div class="form-group">
            {!! Form::label('start', 'Descripcion') !!}
            {{-- {!! Form::text('start', null, ['class' => 'form-control', 'placeholder' => 'Escriba la Descripcion']) !!} --}}
            {!! Form::time('start', null, ['class'=>'form-control', 'placeholder' => 'Ingrese la hora de inicio']) !!}
            @error('start')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
    </div>
    <div class="col-2">
        <div class="form-group">
            {!! Form::label('end', 'Descripcion') !!}
            {{-- {!! Form::text('end', null, ['class' => 'form-control', 'placeholder' => 'Escriba la Descripcion']) !!} --}}
            {!! Form::time('end', null, ['class'=>'form-control', 'placeholder' => 'Ingrese la hora de inicio']) !!}
            @error('end')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
    </div>
</div>
<div class="col">
    <div class="form-group">
        {!! Form::label('descripcion', 'Descripcion del Tema') !!}
        {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Ingrese breve Descripcion','rows' => 4]) !!}
        @error('descripcion')
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
</div>
<div class="col">
    <div class="form-group">
        {!! Form::hidden('id_dicta', $docente_materia->id, ['class' => 'form-control', 'placeholder' => 'dato materia']) !!}
        @error('id_dicta')
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
</div>
