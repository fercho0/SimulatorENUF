@extends('Main.mainperfil')

@section('title', 'Mi perfil')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/alumnoperfil.css') }}">
@endsection

<!-- Contenido Principal -->
@section('imagenprincipal')
<div class="seccionone">
    <img id="pri1" src="/img/pri2.png" alt="">
  </div>
@endsection

<!-- Contenido -->
@section('content')

<center>
  <img id="pri2" src="/img/{{$pro->foto}}" alt="">
   <button id="editimg" class="" data-toggle="modal" data-target="#foto">
          <span  class="glyphicon glyphicon-camera" aria-hidden="true"></span>
    </button>
  <h1>{{$pro->PRO_nombre}} {{$pro->PRO_apellido_p}} {{$pro->PRO_apellido_m}}</h1>
  <hr>
</center>
<div class="container-fluid">
<div class="row">
  <div class="col-sm-6">
    <div class="container-fluid panels">
      <center>
      <h3>Datos personales</h3>
      <hr>
      <table>
        <tr>
          <td colspan="2"><label for="">Nombre</label></td>
        </tr>
        <tr>
          <td><p>{{$pro->PRO_nombre}} {{$pro->PRO_apellido_p}} {{$pro->PRO_apellido_m}}</p></td>
          <td>
            <center>
              <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            </center>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label for="">Sexo</label></td>
        </tr>
        <tr>
          <td><p>{{$pro->PRO_sexo}}</p></td>
          <td>
            <center>
              <span class="glyphicon glyphicon-gift" aria-hidden="true"></span>
            </center>
          </td>
        </tr>
      </table>
      </center>
      <hr>
      <center>
      <table>
        <tr>
          <td colspan="2"><label for="">Calle</label></td>
        </tr>
        <tr>
          <td><p>{{$pro->DIR_calle}}</p></td>
          <td>
            <center>
              <span class="glyphicon glyphicon-road " aria-hidden="true"></span>
            </center>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label for="">Colonia</label></td>
        </tr>
        <tr>
          <td><p>{{$pro->DIR_colonia}}</p></td>
          <td>
            <center>
              <span class="glyphicon glyphicon-flag" aria-hidden="true"></span>
            </center>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label for="">Estado</label></td>
        </tr>
        <tr>
          <td><p>{{$pro->DIR_estado}}</p></td>
          <td>
            <center>
              <span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span>
            </center>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label for="">Ciudad</label></td>
        </tr>
        <tr>
          <td><p>{{$pro->DIR_ciudad}}</p></td>
          <td>
            <center>
              <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
            </center>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label for="">Pais</label></td>
        </tr>
        <tr>
          <td><p>{{$pro->DIR_pais}}</p></td>
          <td>
            <center>
              <span class="glyphicon glyphicon-globe" aria-hidden="true"></span>
            </center>
          </td>
        </tr>
      </table>
      <button id="editar" class="btn-editar" data-toggle="modal" data-target="#personal">
          <span  class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
      </button>
      </center>
    </div>
  </div>
  <div class="col-sm-6 ">
    <div class="container-fluid panels">
      <center>
      <h3>Usuario</h3>
      <hr>
      <table>
        <tr>
          <td colspan="2"><label for="">Nombre de usuario</label></td>
        </tr>
        <tr>
          <td><p>{{$pro->name}}</p></td>
          <td>
            <center>
              <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            </center>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label for="">Email</label></td>
        </tr>
        <tr>
          <td><p>{{$pro->email}}</p></td>
          <td>
            <center>
              <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
            </center>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label for="">Tipo de usuario</label></td>
        </tr>
        <tr>
          <td><p>Profesor</p></td>
          <td>
            <center>
              <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
            </center>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label for="">Contraseña</label></td>
        </tr>
        <tr>
          <td><p>* * * * *</p></td>
          <td>
            <center>
              <span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
            </center>
          </td>
        </tr>
      </table>
      </center>
       <button id="editar" class="btn-user" data-toggle="modal" data-target="#user">
          <span  class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
        </button>
    </div>
  </div>
</div>
</div>
<br>
<br>
<br>
<!--
<a href="#" >{{ Auth::user()->name }} </a>
-->
@endsection


<!-- Modals-->
@section('modal')
<!-- Modal  personal-->
<div class="modal fade" id="personal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel">Actualizar datos personales</h3>
      </div>
      <div class="modal-body">
      {!! Form::open(['route' => ['perfilprofesor.update', $pro->PRO_id],'method' => 'put','id'=>'datosdeformulario']) !!}
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
          {!! Form::label('nombre','Nombre') !!}<br />
          {!! Form::text('nombre',$pro->PRO_nombre,['class'=>'nom','required'])!!}
        </div>
        <div class="form-group">
          {!! Form::label('ap','Apellido materno') !!}<br />
          {!! Form::text('ap',$pro->PRO_apellido_p,['class'=>'ap','required'])!!}
        </div>
        <div class="form-group">
          {!! Form::label('am','Apellido paterno') !!}<br />
          {!! Form::text('am',$pro->PRO_apellido_m,['class'=>'am','required'])!!}
        </div>
        <div class="form-group">
          {!! Form::label('sexo','Sexo') !!}<br>
          <center>
          {{ Form::radio('sex', 'hombre',true) }} Hombre  {{ Form::radio('sex', 'mujer') }} Mujer
          </center>
        </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
          {!! Form::label('calle','Calle') !!}<br />
          {!! Form::text('calle',$pro->DIR_calle,['class'=>'callee','required'])!!}
        </div>
        <div class="form-group">
          {!! Form::label('colonia','Colonia') !!}<br />
          {!! Form::text('colonia',$pro->DIR_colonia,['class'=>'col','required'])!!}
        </div>
        <div class="form-group">
          {!! Form::label('estado','Estado') !!}<br />
          {!! Form::text('estado',$pro->DIR_estado,['class'=>'est','required'])!!}
        </div>
        <div class="form-group">
          {!! Form::label('ciudad','Ciudad') !!}<br />
          {!! Form::text('ciudad',$pro->DIR_ciudad,['class'=>'cd','required'])!!}
        </div>
        <div class="form-group">
          {!! Form::label('pais','Pais') !!}<br />
          {!! Form::text('pais',$pro->DIR_pais,['class'=>'pais','required'])!!}
        </div>
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-button-c" data-dismiss="modal">Cancelar <span class="glyphicon glyphicon-remove"></span></button>
        {{ Form::button('Guardar <span class="glyphicon glyphicon-ok"></span>', array('class'=>'btn-button-a pull-right', 'type'=>'submit')) }}
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
<!-- Fin Personal-->

<!-- Modal  foto-->
<div class="modal fade" id="foto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel">Actualizar Foto</h3>
      </div>
      <div class="modal-body">
        <center>
          <img id="updatefoto" src="/img/{{$pro->foto}}" alt="">
          <br>
          <br>
          {!! Form::open(['route' => ['updateproimg', $pro->id],'method' => 'put','id'=>'datosdeformulario','files'=>'true']) !!}
          <div class="form-group">
            {!! Form::file('file',['class'=>'form-control','id'=>'imgInp']) !!}
          </div>
        </center>
      </div>
      <div class="modal-footer">
        <button type="button" id="cancelarfoto" class="btn-button-c" data-dismiss="modal">Cancelar <span class="glyphicon glyphicon-remove"></span>
        </button>

        {{ Form::button('Guardar <span class="glyphicon glyphicon-ok"></span>', array('class'=>'btn-button-a pull-right', 'type'=>'submit')) }}
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
<!-- Fin Foto-->

<!-- Modal user-->
<div class="modal fade" id="user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel">Actualizar datos de usuario</h3>
      </div>
      <div class="modal-body">

         {!! Form::open(['route' => ['updateuser', $pro->id],'method' => 'put']) !!}
        <div class="form-group">
          {!! Form::label('usuario','Usuario') !!}
            <h3 style=" color: rgb(41, 128, 185);">{{ $pro->name }}</h3>
        </div>
        <div class="form-group">
          {!! Form::label('email','Email') !!}<br />
          {!! Form::email('email',$pro->email,['class'=>'email','required'])!!}
        </div>
        <div class="form-group">
        {!! Form::label('password','Contraseña') !!}<br />
        {{ Form::password('password', ['class' => 'pass','placeholder'=>'***','required']) }}
        </div>
        <div class="form-group">
          {!! Form::label('passwordverific','Verificar contraseña') !!}<br />
          {{ Form::password('passwordverific', ['class' => 'pass','placeholder'=>'***','required']) }}
        </div>
        <br />
      </div>
      <div class="modal-footer">
         <button type="button"  class="btn-button-c" data-dismiss="modal">Cancelar <span class="glyphicon glyphicon-remove"></span></button>
        {{ Form::button('Guardar <span class="glyphicon glyphicon-ok"></span>', array('class'=>'btn-button-a pull-right', 'type'=>'submit')) }}
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
<!-- Fin user-->

@endsection

<!--Script -->
@section('script')
<script type="text/javascript">
var urlimg=$('#updatefoto').attr('src');

function readURL(input)
{
  if (input.files && input.files[0])
  {
  var reader = new FileReader();
    reader.onload = function (e)
    {
      $('#updatefoto').attr('src', e.target.result);
    }
      reader.readAsDataURL(input.files[0]);
  }
}
$("#imgInp").change(function(){
    readURL(this);
});
$("#cancelarfoto").click(function(event)
{
  $("#datosdeformulario")[0].reset();
  $('#updatefoto').attr('src',urlimg);
});
</script>
@endsection


