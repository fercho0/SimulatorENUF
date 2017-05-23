@extends('Main.main')

@section('title', 'Cursos')
@section('styles')
  <link rel="stylesheet" href="{{ asset('css/prialumno.css') }}">
@endsection

<!-- Contenido Principal -->
@section('imagenprincipal')
  <div class="seccionone">
  <img id="pri1" src="/img/pri2.png" alt="">
  </div>
@endsection

<!-- Contenido -->
@section('content')
<style type="text/css">
  table
  {
    width: 100%;  
  }
  table tr td
  {
    text-align: right;
  }
  #texto-a
  {
    text-align: center;
  }
</style>
<div class="row">
  <div class="col-sm-4">
    <br>
    <div class="container-fluid perfildiv">
      <center><br>
        <img id="imgperfil" src="/img/{{$user->foto}}" alt="">
        <br />
        <br />
      </center>
        <label for="">
            Nombre:
        </label>
        <p id="texto-a">
          {{$alumno->ALU_nombre}} {{$alumno->ALU_apellido_p}} {{$alumno->ALU_apellido_m}}
        </p>
        <label for="">Edad:</label>
        <p id="texto-a">
          {{$alumno->ALU_edad}}
        </p>
        <label for="">Sexo:</label>
        <p id="texto-a">
          {{$alumno->ALU_sexo}}
        </p>
        <label for="">Matricula:</label>
        <p id="texto-a">
          {{$alumno->ALU_metricula}}
        </p>
    </div>
  </div>
  <div class="col-sm-8">
  <br>
  <div class="container-fluid">
    @include('flash::message')
  </div>
  <div class="container-fluid
  ">
  <div class="row estatus">
    <div class="col-sm-4">
      <div id="colora">
        <span class="glyphicon glyphicon-stop" aria-hidden="true"></span> Aceptado
      </div>
    </div>
    <div class="col-sm-4">
      <div id="colorp">
        <span class="glyphicon glyphicon-stop" aria-hidden="true"></span> Pendiente
      </div>
    </div>
    <div class="col-sm-4">
      <div id="colorr">
        <span class="glyphicon glyphicon-stop" aria-hidden="true"></span> Rechazado
      </div>
    </div>
  </div>
  </div>
  <hr>
  </div>
  <div class="col-sm-4">
    <center><h2>Mis cursos</h2></center>
@if ($inscrito->count())
    @foreach($inscrito as $ins)
      @if($ins->CUAL_estatus=="aprobado")
       <a href="{{ route('cursos_examen.show', $ins->CUR_id) }}">
        <div class="cursoa">
          <div class="row">
            <div class="col-sm-2">
              <center>
                <img id="imgcursosa" src="/img/{{$ins->CUR_foto}}" alt="">
              </center>
            </div>
            <div class="col-sm-10">
              <h4>{{$ins->CUR_nombre}}</h4>
            </div>
          </div>
        </div>
      </a>
      @elseif($ins->CUAL_estatus=="pendiente")
        <div class="cursop">
          <div class="row">
            <div class="col-sm-2">
              <center>
                <img id="imgcursosp" src="/img/{{$ins->CUR_foto}}" alt="">
              </center>
            </div>
            <div class="col-sm-10">
              <h4>{{$ins->CUR_nombre}}</h4>
            </div>
          </div>
        </div>
      @elseif($ins->CUAL_estatus=="denegado")
        <div class="cursor">
          <div class="row">
            <div class="col-sm-2">
              <center>
                <img id="imgcursosr" src="/img/{{$ins->CUR_foto}}" alt="">
              </center>
            </div>
            <div class="col-sm-10">
              <h4>{{$ins->CUR_nombre}}</h4>
            </div>
          </div>
        </div>
      @endif
    @endforeach
@else
<div class="alert alert-dismissable alert-danger">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <h4>No estas registrardo!</h4>
  <p>en ningun curso</p>
</div>
@endif
  </div>
  <div class="col-sm-4">
    <center><h2>Cursos disponibles</h2></center>
@if ($curso->count())
@foreach ($curso as $cur)
    <a href="{{ route('curos_registro.show', $cur->CUR_id) }}"">
    <div class="cursos">
    <div class="row">
      <div class="col-sm-2">
        <center>
          <img id="imgcursos" src="/img/{{$cur->CUR_foto}}" alt="">
        </center>
      </div>
      <div class="col-sm-10">
        <h4>{{ $cur->CUR_nombre }}</h4>
      </div>
      </div>
    </div>
    </a>
@endforeach
@else
<div class="alert alert-dismissable alert-danger">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Lo sentimos!</strong>
  <p> por el momento no hay cursos disponibles</p>
</div>
@endif
  </div>
</div>
<br>

@endsection

<!-- subcontenido -->
@section('subcontenido')

@endsection

<!-- Modals-->
@section('modal')

@endsection

<!--Script -->
@section('script')

@endsection

