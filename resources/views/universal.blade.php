@extends('Main.main')

@section('title', 'Cursos')

<!-- Contenido Principal -->
@section('imagenprincipal')
  <div class="seccionone">
  </div>
@endsection

<!-- Contenido -->
@section('content')
<h2>contenido</h2>
<a href="#" >{{ Auth::user()->name }} </a>
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


