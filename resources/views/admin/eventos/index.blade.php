@extends('adminlte::page')

@section('title', 'Personal Docente')

@section('content_header')
  <h1>Cronograma Academico</h1>
  <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('content')
  {{-- <progress value="10" max="50"></progress> --}}
  
  @if ($avance == 0)
    <div class="meter">
      0%
    </div>
  @else
    <div class="meter">
      <span style="width: {{$avance}}%; text-align: center">{{$avance}}%</span>
    </div>
  @endif
  @include('admin.eventos.modal-calendar')
  @include('admin.eventos.modal-fastEvents')
  <div class='container-fluid'>
    <div class='row'>
      <div class='col-sm-3'>
        <div id='external-events' >
          <h4>Plan de Materia</h4>

          <div id='external-events-list'>

            @isset($fastEvents)
                @forelse($fastEvents as $fastEvent)
                    <div id="boxFastEvent{{ $fastEvent->id }}"
                        style="padding: 4px; border: 1px solid {{ $fastEvent->color }}; background-color: {{ $fastEvent->color }}"
                        class='fc-event event text-center'
                        data-event='{
                          "id":"{{ $fastEvent->id }}",
                          "title":"{{ $fastEvent->title }}",
                          "color":"{{ $fastEvent->color }}",
                          "start":"{{ $fastEvent->start }}",
                          "end":"{{ $fastEvent->end }}",
                          "descripcion":"{{ $fastEvent->descripcion }}"
                        }'>
                        {{ $fastEvent->title }}
                    </div>
                @empty
                    <p>No hay temas en el plan Academico</p>
                @endforelse
            @endisset

        </div>

          <p>
            <input type='checkbox' id='drop-remove'/>
            <label for='drop-remove'>Eliminar al Insertar</label>
            <button class="btn btn-sm btn-success" id="newFastEvent">Insertar Plan</button>
          </p>
        </div>

        
          
        
      </div>
      <div class='col-sm-9'>
        
        <div 
          id='calendar'
          data-route-load-events="{{ route('routeLoadEvents') }}"
          data-route-event-update="{{ route('routeEventUpdate') }}"  
          data-route-event-store="{{ route('routeEventStore') }}"
          data-route-event-delete="{{ route('routeEventDelete') }}"
          
          data-route-fast-event-delete="{{ route('routeFastEventDelete') }}"
          data-route-fast-event-update="{{ route('routeFastEventUpdate') }}"
          data-route-fast-event-store="{{ route('routeFastEventStore') }}"

          
        ></div>
      </div>  
    </div>
    
      

  </div>


@stop

@section('css')
  <link href='{{asset('assets/fullcalendar/packages/core/main.css')}}' rel='stylesheet' />
  <link href='{{asset('assets/fullcalendar/packages/daygrid/main.css')}}' rel='stylesheet' />
  <link href='{{asset('assets/fullcalendar/packages/timegrid/main.css')}}' rel='stylesheet' />
  <link href='{{asset('assets/fullcalendar/packages/list/main.css')}}' rel='stylesheet' />
 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
  
  <link href='{{asset('assets/fullcalendar/css/style.css')}}' rel='stylesheet' />
  <style>
    .meter {
    box-sizing: content-box;
    height: 20px; /* Can be anything */
    position: relative;
    /* margin: 0px 0 0px 0;  */
    background: rgb(245, 240, 240);
    border-radius: 25px;
    padding: 5px;
    box-shadow:-9px 12px 4px -3px rgba(0,0,0,0.75);
    margin-bottom: 20px;
  }
  .meter > span {
    display: block;
    height: 100%;
    border-top-right-radius: 8px;
    border-bottom-right-radius: 8px;
    border-top-left-radius: 20px;
    border-bottom-left-radius: 20px;
    background-color: rgb(43, 194, 83);
    background-image: linear-gradient(
      center bottom,
      rgb(43, 194, 83) 37%,
      rgb(84, 240, 84) 69%
    );
    box-shadow: inset 0 2px 9px rgba(255, 255, 255, 0.3),
      inset 0 -2px 6px rgba(0, 0, 0, 0.4);
    position: relative;
    overflow: hidden;
  }
  .meter > span:after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    background-image: linear-gradient(
      -45deg,
      rgba(255, 255, 255, 0.2) 25%,
      transparent 25%,
      transparent 50%,
      rgba(255, 255, 255, 0.2) 50%,
      rgba(255, 255, 255, 0.2) 75%,
      transparent 75%,
      transparent
    );
    z-index: 1;
    background-size: 50px 50px;
    animation: move 2s linear infinite;
    border-top-right-radius: 8px;
    border-bottom-right-radius: 8px;
    border-top-left-radius: 20px;
    border-bottom-left-radius: 20px;
    overflow: hidden;
  }
  
  .animate > span:after {
    display: none;
  }
  
  @keyframes move {
    0% {
      background-position: 0 0;
    }
    100% {
      background-position: 50px 50px;
    }
  }
  </style>
@stop

@section('js')
<script src='{{asset('assets/fullcalendar/packages/core/main.js')}}'></script>
<script src='{{asset('assets/fullcalendar/packages/interaction/main.js')}}'></script>
<script src='{{asset('assets/fullcalendar/packages/daygrid/main.js')}}'></script>
<script src='{{asset('assets/fullcalendar/packages/timegrid/main.js')}}'></script>
<script src='{{asset('assets/fullcalendar/packages/list/main.js')}}'></script>

<script src='{{asset('assets/fullcalendar/packages/core/locales-all.js')}}'></script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js'></script>

{{-- {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>  --}}
<script>let objCalendar;</script>
<script src='{{asset('assets/fullcalendar/js/script.js')}}'></script>
<script src='{{asset('assets/fullcalendar/js/calendar.js')}}'></script>
    
@stop