@extends('adminlte::page')

@section('title', 'Personal Docente')

@section('content_header')
    <h1>Editar plan</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($plan, ['route'=>['admin.plans.update', [$docente_materia,$plan]], 'method'=>'put']) !!}
                @include('admin.plans.partials.form')
                {!! Form::submit('Actualizar Contenido', ['class'=>'btn btn-success']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop