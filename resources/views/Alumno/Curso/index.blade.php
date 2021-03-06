@extends('Main.main')

@section('title', 'Registro')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
  <link rel="stylesheet" href="{{ asset('css/alumnocursoindex.css') }}">
  <link rel="stylesheet" href="{{ asset('css/adminprofesor.css') }}">
@endsection

<!-- Contenido Principal -->
@section('imagenprincipal')
  <div class="seccionone">
  <img id="pri1" src="/img/pri2.png" alt="">
  </div>
@endsection

<!-- Contenido -->
@section('content')
<!--
<div class="col-sm-3">
    <div class="card hovercard">
     @if($alumno->ALU_sexo=="hombre")
    <div class="cardheader"></div>
     @else
      <div class="cardheader2"></div>
       @endif
        <div class="avatar">
             <img alt="" src="/img/{{$foto}}">
             </div>
              <div class="info">
                    <div class="title">
                        {{$alumno->ALU_nombre}} {{$alumno->ALU_apellido_p}} {{$alumno->ALU_apellido_m}}
                    </div>
                    <div class="title"><h3>Matricula:{{$alumno->ALU_metricula}}</h3></div>
                    <div class="title"><h3>Edad:{{$alumno->ALU_edad}}</h3></div>
                    <div class="title"><h3>Sexo:{{$alumno->ALU_sexo}}</h3></div>

                </div>
            </div>
         </div>
         -->
  <div class="col-sm-12">
    <br>
    <div class="curse">
    <center><h1>{{ $curso->CUR_nombre }}</h1>
      <img id="tamanofoto" src="/img/{{$curso->CUR_foto}}" alt="" style="width: 200px; height: 150px; border-radius: 5%;">
    </center>
  </div>
  <div class="col-sm-12">
    <h3>Descripción</h3>
      <p>{{ $curso->CUR_descripcion }}
      </p>
    <hr>
  </div>
  <div class="col-sm-9">
  <div class="container-fluid">
@if ($unidad->count())
    <h3>Contenido del tema</h3>
    @foreach($unidad as $uni)
    <div id="vertical-bar" table-responsive>

        <table>
          <tr>
            <td>
              <div class="btn-circle"><br>
                <span class="glyphicon glyphicon-star starr" aria-hidden="true"></span>
              </div>
            </td>
            <td class="separador"></td>
            <td><h5>{{ $uni->UNI_nombre }}</h5></td>
          </tr>
        </table>
      </div>
      @endforeach
@else
<div class="alert alert-dismissable alert-danger">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Lo sentimos!</strong> Por el momento el curso no tiene contenido
</div>
@endif
</div>
    </div>
    <div class="col-sm-3">
            <div class="card hovercard">
            @if($pro->PRO_sexo=="hombre")
                <div class="cardheader">

                </div>
            @else
                <div class="cardheader2">

                </div>
            @endif
                <div class="avatar">
                <center>
                    <img alt="" src="/img/{{$pro->foto}}">
                </div>
                <div class="info">
                    <div class="title">
                    <center>
                        {{ $pro->PRO_nombre }} {{ $pro->PRO_apellido_p }} {{ $pro->PRO_apellido_m }}
                        </center>
                    </div>
                    <center>
                    <div class="title"><h3>Profesor asignado</h3></div>
                    </center>
                </div>
                <center>
          <span class="glyphicon glyphicon-star-empty star" aria-hidden="true"></span>
          <span class="glyphicon glyphicon-star-empty star" aria-hidden="true"></span>
          <span class="glyphicon glyphicon-star-empty star" aria-hidden="true"></span>
          <span class="glyphicon glyphicon-star-empty star" aria-hidden="true"></span>
          <span class="glyphicon glyphicon-star-empty star" aria-hidden="true"></span>
        </center>
      </div>
    </div>

  </div>
    <br>
    <div class="col-sm-12">
      <div class="container-fluid">
        @include('flash::message')
      </div>
    <hr>
    <h3>Registrarme en Tema:</h3>
    {!! Form::open(['route'=>'curos_registro.store','method'=>'POST']) !!}
      {{ Form::hidden('idcurso',$curso->CUR_id)}}
      {{ Form::hidden('idalumno',$alumno->ALU_id)}}
      {{ Form::text('clave',null,['class'=>'clave','placeholder'=>'Ingresa la clave del tema','required'])}}<br><br>
      <center>
      {{ Form::button('Registrarme', array('class'=>'btn-registro', 'type'=>'submit')) }}<br><br>
      </center>
    {!! Form::close() !!}
    </div>
  </div>
</div>
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

