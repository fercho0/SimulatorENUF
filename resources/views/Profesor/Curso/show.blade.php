@extends('Main.mainprofesor')

@section('title', 'Curso')
@section('styles')
  <link rel="stylesheet" href="{{ asset('css/button-menu.css') }}">
  <link rel="stylesheet" href="{{ asset('css/profesorcursosshow.css') }}">
@endsection
@section('imagenprincipal')
  <div class="seccionone">
    <img id="pri1" src="/img/pri2.png" alt="">
  </div>
@endsection
<!-- Inicio Section Contenido -->
@section('content')
<div class="container-fluid">
<div class="row">
  <div class="col-sm-12"><center><h1>{{$curso->CUR_nombre}}</h1></center><br></div>

  <div class="col-sm-4">
    <center>
      <p id="centradop">Cupos del curso</p>
      <h2>
        <span class="label label-primary">
          # {{ $curso->CUR_cupos}}
        </span>
      </h2>
    </center>
  </div>
  <div class="col-sm-4">
    <center>
      <p id="centradop">Cupos disponibles</p>
      <h2>
        <span class="label label-success">
          # {{ $curso->CUR_cupos}}
        </span>
      </h2>
    </center>
  </div>
  <div class="col-sm-4">
    <center>
      <p id="centradop">Fecha</p>
      <h2>
        <span class="label label-default">
          {{ $curso->CUR_fecha}}
        </span>
      </h2>
    </center>
  </div>
</div>
<hr>
<div class="row">
  <div class="col-sm-6">
  <div class="container-fluid">
    <center><h2>Alumnos</h2></center>
    <div class="row">
      <!-- Alumnos inicio -->
      @foreach($pendiente as $pen)
      <h3>Alumnos Pendientes</h3>
      <hr>
      <!-- Alumnos pendiente -->
      <div class="col-sm-12 cuadro">
        <div class="col-sm-1">
          <img id="alumnosimg" src="/img/{{ $pen->foto }}" alt="">
        </div>
        <div class="col-sm-5">
         <center> <p id="textcenter">{{ $pen->ALU_nombre }} {{ $pen->ALU_apellido_p }} {{ $pen->ALU_apellido_m }}</p></center>
        </div>
        <div class="col-sm-3">
          <button class="btn-denegar">Denegar <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        </div>
        <div class="col-sm-3">
          <button class="btn-aprobar">Aprobar <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
        </div>
      </div>
      <!-- pendiente fin -->
      @endforeach

      @foreach($aprobado as $apro)
      <h3>Alumnos Aprobados</h3>
      <hr>
      <!-- Alumnos aprobado -->

      <div class="col-sm-12 cuadro">
        <div class="col-sm-1">
          <img id="alumnosimg" src="/img/{{ $apro->foto }}" alt="">
        </div>
        <div class="col-sm-5">
         <center> <p id="textcenter">{{ $apro->ALU_nombre }} {{ $apro->ALU_apellido_p }} {{ $apro->ALU_apellido_m }}</p></center>
        </div>
        <div class="col-sm-3">
          <button class="btn-denegar">Denegar <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        </div>
        <div class="col-sm-3">
          <button class="btn-ver">Ver... <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button>
        </div>
      </div>
      <!-- fin aprobado -->
      @endforeach

      @foreach($denegado as $dene)
      <!-- alumno denegado -->
      <h3>Alumnos Rechazados</h3>
      <hr>

      <div class="col-sm-12 cuadro">
        <div class="col-sm-1">
          <img id="alumnosimg" src="/img/{{ $dene->foto }}" alt="">
        </div>
        <div class="col-sm-7">
         <center> <p id="textcenter">{{ $dene->ALU_nombre }} {{ $dene->ALU_apellido_p }} {{ $dene->ALU_apellido_m }}</p></center>
        </div>
        <div class="col-sm-4">
          <button class="btn-aprobar">Aprobar</button>
        </div>
      </div>
      <!-- fin denegado -->
      @endforeach
      <!-- Alumnos fin -->
    </div>
  </div>
  </div>
  <div class="col-sm-6">
  <div class="container-fluid">
    <center><h2>Unidades</h2></center>
    <div class="row">
    @if ($unidad->count())
    @foreach ($unidad as $uni)
      <a href="{{ route('unidad.show', $uni->UNI_id) }}">
      <div class="col-sm-12 cuadro">
        <div class="col-sm-2">
          <img id="alumnosimg" src="/img/book1.png" alt="">
        </div>
        <div class="col-sm-7"><br>
          <p id="textcenterunidad">{{ $uni->UNI_nombre }}</p>
        </div>
        <div class="col-sm-3"><br>
          <p id="textcenterunidad">{{ $uni->UNI_fecha_final }}</p>
        </div>
      </div>
      </a>
    @endforeach
    @else
    <div class="alert alert-dismissable alert-danger">
      <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Porfavor!</strong> agrege una unidad al curso
      </div>
    @endif
    </div>
  </div>
  </div>
</div>
</div>
  <br>
  <br>
  <br>
  <br>
  <br>

<div class="contenedor">
<button class="botonF1" data-toggle="modal" data-target="#unidad"  data-tooltip="Nueva Unidad">
  <span>+</span>
</button>


<!--
<button class="btn-m botonF4 tooltip-right tooltip-right3" data-toggle="modal" data-target="#login"  data-tooltip="ffff">
  <span>+</span>
</button>
<button class="btn-m botonF5 tooltip-right tooltip-right4" data-toggle="modal" data-target="#login"  data-tooltip="ffff">
  <span>+</span>
</button>
-->
</div>
@endsection
<!-- Fin Section Contenido -->

@section('subcontenido')
<div class="row">
  <div class="col-sm-4"></div>
  <div class="col-sm-4"></div>
  <div class="col-sm-4"></div>
</div>
@endsection


<!-- Inicio Section Modal -->

@section('modal')


<!-- Modal Unidad -->
<div class="modal" id="unidad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body">
        {!! Form::open(['route'=>'unidad.store','method'=>'POST','files' => true]) !!}
        <div class="form-group">
          {!! Form::text('curso',$curso->CUR_id,['class'=>'inputoculto','readonly'])!!}
        </div>
        <div class="form-group">
        {!! Form::label('file','Material de apoyo') !!}
        {!! Form::file('file',['class'=>'form-control','onchange'=>'previewFile()']) !!}</p>
        </div>
        <div class="form-group">
          {!! Form::label('nombre','Nombre de unidad') !!}
          {!! Form::text('nombre',null,['class'=>'form-control','required'])!!}
          <p>Solo puede contener 34 caracteres A-Z | 0-9</p>
        </div>
        <div class="form-group">
          {!! Form::label('fecha','Fecha de examen final') !!}
          {!! Form::date('fecha',null,['class'=>'form-control','required'])!!}
        </div>
        <div class="form-group">
          {!! Form::label('tiempo','Duración de examen final') !!}
          {!! Form::time('tiempo',null,['class'=>'form-control','required'])!!}
        </div>
        <div class="form-group">
          {!! Form::label('numero','Numero de preguntas de examen final') !!}
          {!! Form::number('numero',null,['class'=>'form-control','required'])!!}
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">
          Cancelar
          <span class="glyphicon glyphicon-remove"></span>
        </button>
        {{ Form::button('Agregar <span class="glyphicon glyphicon-ok"></span>',
          array('class'=>'btn btn-success pull-right', 'type'=>'submit')) }}
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
<!-- Modal Final Unidad -->

@endsection
<!-- Fin Section Modal -->

<!-- Inicio Section Script -->
@section('script')
<script type="text/javascript">
  $('.botonF1').click(function()
  {
  $('.btn-m').addClass('animacionVer');
  })
  $('.contenedor').mouseleave(function()
  {
  $('.btn-m').removeClass('animacionVer');
  })
  </script>

<!-- Fin Section Script -->


@endsection


</body>
</html>
