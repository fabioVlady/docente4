@extends('adminlte::page')

@section('title', 'Personal Docente')

@section('content_header')
    <h1>Editar periodo</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($periodo, ['route'=>['admin.periodos.update', $periodo], 'method'=>'put']) !!}
                @include('admin.periodos.partials.form')
                {!! Form::submit('Actualizar periodo', ['class'=>'btn btn-success']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop