
@extends('Main.main')

@section('title', 'Examenes')

@section('styles')
  <link rel="stylesheet" href="{{ asset('plugins/confirm/sweetalert.css') }}">
  <link rel="stylesheet" href="{{ asset('css/adminprofesor.css') }}">
  <link rel="stylesheet" href="{{ asset('css/alumnocursoshow.css') }}">
@endsection

<!-- Contenido Principal -->
@section('imagenprincipal')
  <div class="seccionone">
  <img id="pri1" src="/img/pri2.png" alt="">
  </div>
@endsection

<!-- Contenido -->
@section('content')
<div class="row">
<div class="col-sm-3">
    <div class="card hovercard">
     @if($alumno->ALU_sexo=="hombre")
    <div class="cardheader"></div>
     @else
      <div class="cardheader2"></div>
       @endif
        <div class="avatar">
             <img id="imgperfil" src="/img/{{$user->foto}}" alt="">
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
  <div class="col-sm-9">
  <br>
    <div class="curse">
    <center><h1>{{ $curso->CUR_nombre }}</h1>
    <img id="tamanofoto" src="/img/{{ $curso->CUR_foto }}" alt="" style="width: 100px; height: 100px; border-radius: 50%;">
    </center>
  </div>
  <div class="col-sm-12">
    <h2>Descripción</h2>
      <p>{{ $curso->CUR_descripcion }}
      </p>
    <hr>
    <h2>Reglas</h2>
    <p>1. El examen final y el examen global solo permite tres intentos.</p>
    <p>2. El examen de prueba no tiene limite de intentos.</p>
    <hr>
  </div>
  <div class="col-sm-12">
    <h2>Unidades</h2>
    @foreach($unidad as $uni)
<div class="unidad">
<div class="table-responsive">
<table  style="width: 100%;">
<tr>
  <td colspan="5">
    <center><h2>{{$uni->UNI_nombre}}</h2></center>
  </td>
</tr>
  <tr>
    <td><center><h3>Intentos</h3></center></td>
    <td><center><h3>Fecha inicio</h3></center></td>
    <td><center><h3>Fecha final</h3></center></td>
    <td><center><h3>Calificiacion</h3></center></td>
  </tr>
  <tr>
  <!-- aqui -->
  @php
    $a=0;
    $b=0
  @endphp
  @if ($unialu->count())
  @foreach($unialu as $unii)
  @if($unii->UNI_id==$uni->UNI_id)
    @if($unii->UNAL_intentos>=1)
    <td>
      <center>
        {{$unii->UNAL_intentos}}
      </ceter>
    </td>
    @endif
        @php
          $b=$unii->UNAL_intentos;
        @endphp
      @break;
    @endif
@endforeach
@endif
@if($a>=$b)
<td><center>0</center></td>
@endif
    <td>
      <center>{{$uni->UNI_fecha_inicio}}</center>
    </td>
    <td>
      <center>{{$uni->UNI_fecha_final}}</center>
    </td>
    <td>
      <center>
      @if ($unialu->count())
      @if($unii->UNI_id == $uni->UNI_id)
      
      @if($unii->UNAL_calificacion>=1)
        {{$unii->UNAL_calificacion}}
      @elseif($unii->UNAL_calificacion === 0)
        0
      @else
        pendiente
      @endif

      @endif
      
      @else
        Pendiente
      @endif
      </center>
    </td>
  </tr>
</table>
</div>
<hr>
<center>
@if($uni->UNI_fecha_inicio<=$fecha &&  $uni->UNI_fecha_final>=$fecha)
  <a href="{{ route('examenprueba', $uni->UNI_id) }}" style="text-decoration: none;">
    <span class="label label-success">Examen de prueba</span>
  </a>

  @if($b<3)
    <span class="label label-success" style="cursor:pointer" onclick="Envio({{$uni->UNI_id}});">Examen final</span>
  @else
    <span class="label label-default">Examen final</span>
  @endif



@else
  <span class="label label-default">Examen de prueba</span>
  <span class="label label-default">Examen final</span>
@endif
  <a href="{{ route('detalleunidad', $uni->UNI_id) }}">
    <span class="label label-primary">Ver detalles</span>
  </a>
@if($uni->UNI_material_apoyo=="")
  <span class="label label-default label-circle">Material
    <span class="glyphicon glyphicon-download" aria-hidden="true"></span>
  </span>
@else
  <a href="{{ route('descargafiles', $uni->UNI_id) }}">
    <span class="label label-success label-circle">Material
      <span class="glyphicon glyphicon-download" aria-hidden="true"></span>
    </span>
  </a>
  @endif
</center>
   </div>
@endforeach

<!--Global -->
<div class="unidad">
<div class="table-responsive">
<table  style="width: 100%;">
<tr>
  <td colspan="5">
    <center><h2>Examen Global</h2></center>
  </td>
</tr>
  <tr>
    <td><center><h3>Intentos</h3></center></td>
    <td><center><h3>Fecha inicio</h3></center></td>
    <td><center><h3>Fecha final</h3></center></td>
    <td><center><h3>Calificación</h3></center></td>
  </tr>
  <tr>
    <td>
      <center>
        @if($cursoo->CUAL_intentos)
          {{ $cursoo->CUAL_intentos }}
        @else
          0
        @endif
      </center>
    </td>
    <td>
      <center>
        @if($curso->CUR_fecha_inicio)
          {{ $curso->CUR_fecha_inicio }}
        @else
          pendiente
        @endif
      </center>
    </td>
    <td>
       <center>
        @if($curso->CUR_fecha_final)
          {{ $curso->CUR_fecha_final }}
        @else
          pendiente
        @endif
      </center>
    </td>
    <td>
      <center>
        @if($cursoo->CUAL_calificacion)
       {{$cursoo->CUAL_calificacion}}
       @else
        pendiente
       @endif
      </center>
    </td>
  </tr>
</table>
</div>
<hr>
<center>
@if($curso->CUR_estatus_examen=="habilitado")
  @if($cursoo->CUAL_intentos<3)
   <span class="label label-success" style="cursor:pointer" onclick="Global({{$curso->CUR_id}});">
    Relaizar examen global
  </span>
  @else
     <span class="label label-default">Relaizar examen global</span>
  @endif

@else
  <span class="label label-default">Relaizar examen global</span>
@endif
</center>
   </div>
      <br>
      <br>
    </div>
  </div>
</div>

<!--Fin global-->
@endsection

<!-- subcontenido -->
@section('subcontenido')

@endsection

<!-- Modals-->
@section('modal')

@endsection

<!--Script -->
@section('script')
<script  src="{{ asset('plugins/confirm/sweetalert.min.js') }}"></script>
<!--  AQUI tambien -->

<script type="text/javascript">
var Envio=function(id){
swal({
  title: "Relizar Examen?",
  text: "empezar ahora!",
  type: "success",
  showCancelButton: true,
  confirmButtonColor: '#2ECC71',
  confirmButtonText: 'Confirmar',
  cancelButtonText: "Cancelar!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm) {
  if (isConfirm) {
    window.location.href = "{{url('alumno/examenfinal')}}/"+id+"";
  }
  else {
  swal("Cancelado", ":)", "error");
  }
});
}

var Global=function(id){
swal({
  title: "Presentar Examen Global?",
  text: "empezar ahora!",
  type: "success",
  showCancelButton: true,
  confirmButtonColor: '#2ECC71',
  confirmButtonText: 'Confirmar',
  cancelButtonText: "Cancelar!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm) {
  if (isConfirm) {
    window.location.href = "{{url('alumno/globalshow')}}/"+id+"";
  }
  else {
  swal("Cancelado", ":(", "error");
  }
});
}
</script>
@endsection

