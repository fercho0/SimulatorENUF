<!DOCTYPE html>
<html lang="es">
<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-108507917-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-108507917-1');
</script>

  <meta charset="UTF-8">
  <title>@yield('title','Default')</title>
  <link rel="icon" href="/img/curso.png">
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
  <link rel="stylesheet" href="{{ asset('css/welcomee.css') }}">
  
  @yield('styles')
</head>

<header>
  @include('Main.welcomenav')
</header>
<body>
<br>
<br>
<br>
<br>
@yield('imagenprincipal')


<div class="container panelhistoria">
  <div class="container-fluid subpanelhistoria">

    @yield('content')
  </div>

</div>
<div class="container-fluid contenerdor1">
@yield('subcontenido')
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-4 subfinal">
    <center>
    <div class="container-fluid panelimg">
      <br>
      <img src="/img/alumno.png" alt="" id="divimg">
      <p><span class="badge">{{$alumnos}}</span></p>
      <h3>Alumnos</h3>
    </div>
    </center>
    </div>

    <div class="col-sm-4 subfinal">
    <center>
    <div class="container-fluid panelimg">
      <br>
      <img src="/img/cursos.png" alt="" id="divimg">
        <p><span class="badge">{{$cursos}}</span></p>
      <h3>Cursos</h3>
    </div>
    </center>
    </div>
    <div class="col-sm-4 subfinal">
    <center>
    <div class="container-fluid panelimg">
      <br>
      <img src="/img/profesor.png" alt="" id="divimg">
      <p><span class="badge">{{$profesores}}</span></p>
      <h3>Profesores</h3>
    </div>
    </center>
    </div>

  </div><br><br>
</div>

<footer class="footer">
      <div class="container-fluid">
       <div class="row">
         <div class="col-sm-4"><br>
          <p id="pfooter">Centro Escolar Vicente Guerrero, Col. Jardines del Sur, Chilpancingo,Gro.</p>
          <p id="pfooter">C.P.39070</p>
         </div>
         <div class="col-sm-4"><br>
            <p id="pfooter">Contactanos</p>
            <p id="pfooter">Tel:(747) 47 2 52 27
            <p id="pfooter">e-mail: profesorrafaelramirez@outlook.es</p>
          </div>
         <div class="col-sm-4"><br>
          <a href=""> <img src="img/guerrero.png" alt="" id="guerrero"></a>
         </div>
       </div>
      </div>
      <!--
      <button type="button" data-toggle="modal" data-target="#myModal" id="fixedbutton" class="btn btn-danger btn-circle btn-lg">
        <span class="glyphicon glyphicon-info-sign"></span>
      </button>
      -->
</footer>
@yield('modal')
<script  src="{{ asset('plugins/jQuery/jquery-3.1.1.js') }}"></script>
<script  src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>


<script>
  $(window).scroll(function() {
    $('#logo').each(function(){
    var imagePos = $(this).offset().top;

    var topOfWindow = $(window).scrollTop();
      if (imagePos < topOfWindow+800) {
        $(this).addClass("hatch");
      //alert("hjdshjsd");

      }
    });
  });
</script>
  @yield('script')

</body>
</html>
