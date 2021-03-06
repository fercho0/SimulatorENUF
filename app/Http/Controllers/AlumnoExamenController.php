<?php

namespace SimulatorENUF\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Laracasts\Flash\Flash;
use SimulatorENUF\Models\Curso;
use SimulatorENUF\Models\Unidad;
use SimulatorENUF\Models\Alumno;
use SimulatorENUF\Models\Pregunta;
use SimulatorENUF\Models\Respuesta;
use SimulatorENUF\Models\Examen;
use SimulatorENUF\Models\CurAlu;
use SimulatorENUF\Models\UniAlu;
use SimulatorENUF\User;

use DB;


class AlumnoExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function globalfinal(Request $request)
    {
      $iduseralumno = Auth::user()->id;
      $alumno=Alumno::where('USE_id', $iduseralumno)->first();
      $idalumno=$alumno->ALU_id;
      $b=4;
      $intent=0;
      $c=1;
      $vv=0;
      $cal=0;
      $rescorrecta=0;
      $cantidadres=(int)($request->cantidad)*4;
      #echo $cantidadres;
      $cantidad=(int)($request->cantidad);
      #echo "cantidad=".$cantidad."<br>";
      for($i=1;$i<=$cantidad;$i++)
      {
        $pre="pre".$i;
        $pregunta=Respuesta::select('*')->where('PRE_id','=',$request->$pre)->where('TIP_id','=',1)->get();
        $cantidadcorrectas=count($pregunta); #cantidad de respuestas correctas
        for ($a=$c; $a<=$cantidadres; $a++)
        {
          $res="res".$a;
          $respuesta=($request->$res);
          if(isset($respuesta))
          {
            $verificar=Respuesta::find($respuesta);
            if ($verificar->TIP_id==1)
            {
              $vv=$vv+1;
            }
            else
            {
              $vv=$vv-1;
            }
          }
          if($a==$b)
          {
            if ($vv==$cantidadcorrectas)
            {
              $cal=$cal+1;
            }
              $b=$b+4;
              $c=$a+1;
              $vv=0;
              break;
          }
        }
      }
      $calfinal=round($cal*10/$cantidad);
      $hora= date("h:i:s a");
      $fecha=date('Y-m-d');
      $examen=new Examen;
      $examen->EXA_nombre="Examen global";
      $examen->EXA_fecha=$fecha;
      $examen->EXA_hora=$hora;
      $examen->EXA_calificacion=$calfinal;
      $examen->EXA_tiempo=$hora;//pendiente tiempo del examen
      $examen->UNI_id=($request->unidadid);
      $examen->TIP_id=5;
      $examen->ALU_id=$idalumno;
      $examen->save();

      if($examen){

        $totalintentos=Examen::select('*')->where('UNI_id','=',$request->unidadid)->where('TIP_id','=',5)->where('ALU_id','=',$idalumno)->get();

        foreach ($totalintentos as $totalin) {
          $intent++;
        }

        $uni_alus=CurAlu::where('CUR_id',$request->unidadid)->where('ALU_id','=',$idalumno)->first();
        $uni_alus->CUAL_calificacion=$calfinal;
        $uni_alus->CUAL_intentos=$intent;
        $uni_alus->save();
        if($uni_alus){
          $idcurso=($request->unidadid);
          return view('Alumno.Curso.resultado')
          ->with('cal',$calfinal)
          ->with('id',$idcurso);
        }
      }
    }

     public function finalExamen(Request $request)
    {
      $iduseralumno = Auth::user()->id;
      $alumno=Alumno::where('USE_id', $iduseralumno)->first();
      $idalumno=$alumno->ALU_id;
      $b=4;
      $intent=0;
      $c=1;
      $vv=0;
      $cal=0;
      $rescorrecta=0;
      $cantidadres=(int)($request->cantidad)*4;
      #echo $cantidadres;
      $cantidad=(int)($request->cantidad);
      #echo "cantidad=".$cantidad."<br>";
      for($i=1;$i<=$cantidad;$i++)
      {
        $pre="pre".$i;
        $pregunta=Respuesta::select('*')->where('PRE_id','=',$request->$pre)->where('TIP_id','=',1)->get();
        $cantidadcorrectas=count($pregunta); #cantidad de respuestas correctas
        for ($a=$c; $a<=$cantidadres; $a++)
        {
          $res="res".$a;
          $respuesta=($request->$res);
          if(isset($respuesta))
          {
            $verificar=Respuesta::find($respuesta);
            if ($verificar->TIP_id==1)
            {
              $vv=$vv+1;
            }
            else
            {
              $vv=$vv-1;
            }
          }
          if($a==$b)
          {
            if ($vv==$cantidadcorrectas)
            {
              $cal=$cal+1;
            }
              $b=$b+4;
              $c=$a+1;
              $vv=0;
              break;
          }
        }
      }
      $calfinal=round($cal*10/$cantidad);
      $hora= date("h:i:s a");
      $fecha=date('Y-m-d');
      $examen=new Examen;
      $examen->EXA_nombre="Examen Final";
      $examen->EXA_fecha=$fecha;
      $examen->EXA_hora=$hora;
      $examen->EXA_calificacion=$calfinal;
      $examen->EXA_tiempo=$hora;//pendiente tiempo del examen
      $examen->UNI_id=($request->unidadid);
      $examen->TIP_id=4;
      $examen->ALU_id=$idalumno;
      $examen->save();

      if($examen){

        $totalintentos=Examen::select('*')->where('UNI_id','=',$request->unidadid)->where('TIP_id','=',4)->where('ALU_id','=',$idalumno)->get();

        foreach ($totalintentos as $totalin) {
          $intent++;
        }

        $uni_alus=UniAlu::where('UNI_id',$request->unidadid)->where('ALU_id','=',$idalumno)->first();

        $uni_alus->UNAL_calificacion=$calfinal;
        $uni_alus->UNAL_intentos=$intent;
        $uni_alus->save();

        /*
        dd($uni_alus);
        $unidad=Unidad::find($request->unidadid);
        $unidad->UNI_calificacion=$calfinal;
        $unidad->UNI_intento=$intent;
        $unidad->save();
        */
        if($uni_alus){

          $idcurso=($request->unidadid);
          return view('Alumno.Curso.resultado')
          ->with('cal',$calfinal)
          ->with('id',$idcurso);

        }
      }
    }



    public function store(Request $request)
    {
      $iduseralumno = Auth::user()->id;
      $alumno=Alumno::where('USE_id', $iduseralumno)->first();
      $idalumno=$alumno->ALU_id;

      $b=4;
      $c=1;
      $vv=0;
      $cal=0;
      $rescorrecta=0;
      $cantidadres=(int)($request->cantidad)*4;
      #echo $cantidadres;
      $cantidad=(int)($request->cantidad);
      #echo "cantidad=".$cantidad."<br>";
      for($i=1;$i<=$cantidad;$i++)
      {
        $pre="pre".$i;
        $pregunta=Respuesta::select('*')->where('PRE_id','=',$request->$pre)->where('TIP_id','=',1)->get();
        $cantidadcorrectas=count($pregunta); #cantidad de respuestas correctas
        for ($a=$c; $a<=$cantidadres; $a++)
        {
          $res="res".$a;
          $respuesta=($request->$res);
          if(isset($respuesta))
          {
            $verificar=Respuesta::find($respuesta);
            if ($verificar->TIP_id==1)
            {
              $vv=$vv+1;
            }
            else
            {
              $vv=$vv-1;
            }
          }
          if($a==$b)
          {
            if ($vv==$cantidadcorrectas)
            {
              $cal=$cal+1;
            }
              $b=$b+4;
              $c=$a+1;
              $vv=0;
              break;
          }
        }
      }

      $hora= date('h:i:s a');
      $fecha=date('Y-m-d');
      $examen=new Examen;
      $examen->EXA_nombre="Examen prueba";
      $examen->EXA_fecha=$fecha;
      $examen->EXA_hora=$hora;
      $examen->EXA_calificacion=$cal;
      $examen->EXA_tiempo=$hora;//pendiente tiempo del examen
      $examen->UNI_id=($request->unidadid);
      $examen->TIP_id=3;
      $examen->ALU_id=$idalumno;
      $examen->save();

      if($examen){
          $idcurso=($request->unidadid);
          return view('Alumno.Curso.resultado')
          ->with('cal',$cal)
          ->with('id',$idcurso);
      }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


      $iduseralumno = Auth::user()->id;
      $user=User::find($iduseralumno);
      $alumno=Alumno::where('USE_id', $iduseralumno)->first();
      $aluid=$alumno->ALU_id;
      $curso=Curso::find($id);
      $cursoo=CurAlu::where('CUR_id', $id)->where('ALU_id', $aluid)->first();

      $unidad=Unidad::select('*')->where('CUR_id','=',$id)
      ->get();
      $uni_alus=UniAlu::where('ALU_id','=',$aluid)->get();


      #dd($uni_alus);
      $fecha=date('Y-m-d');
      #dd($uni_alus);

      return view('Alumno.Curso.show')
      ->with('curso',$curso)
      ->with('cursoo',$cursoo)
      ->with('alumno',$alumno)
      ->with('user',$user)
      ->with('fecha',$fecha)
      ->with('unialu',$uni_alus)
      ->with('unidad',$unidad);
    }
    public function descargafiles($id)
    {
        $unidad=Unidad::find($id);
        $path=public_path().'/files/documents/'.$unidad->UNI_material_apoyo;
        return response()->download($path);
    }

    public function globalshow($id)
    {
      $iduseralumno = Auth::user()->id;
      $alumno=Alumno::where('USE_id', $iduseralumno)->first();
      $idalumno=$alumno->ALU_id;
      #$unidad=Unidad::find($id);
      #$pre=$unidad->UNI_numero_pregunta;
      $unidad=Curso::find($id);
      $pre=$unidad->CUR_numero_preguntas;
      $i=1;
      $p=1;
      $iddd=1;
      $num=1;
      $div=1;
      $pregunta=Pregunta::inRandomOrder()->select('*')->where('CUR_id','=',$id)->limit($pre)->get();
      $respuesta=Respuesta::inRandomOrder()->get();
     # $verific=CurAlu::where('CUR_id',$id)->where('ALU_id','=',$idalumno)->first();

      return view('Alumno.Curso.global')
      ->with('alumno',$alumno)
      ->with('pregunta',$pregunta)
      ->with('i',$i)
      ->with('p',$p)
      ->with('div',$div)
      ->with('iddd',$iddd)
      ->with('num',$num)
      ->with('respuesta',$respuesta)
      ->with('unidad',$unidad);
    }

    public function examenfinal($id)
    {

      $iduseralumno = Auth::user()->id;
      $alumno=Alumno::where('USE_id', $iduseralumno)->first();
      $idalumno=$alumno->ALU_id;
      $unidad=Unidad::find($id);
      $pre=$unidad->UNI_numero_pregunta;
      $i=1;
      $p=1;
      $iddd=1;
      $num=1;
      $div=1;
      $pregunta=Pregunta::inRandomOrder()->select('*')->where('UNI_id','=',$id)->limit($pre)->get();
      $respuesta=Respuesta::inRandomOrder()->get();
      $verific=UniAlu::where('UNI_id',$id)->where('ALU_id','=',$idalumno)->first();
      if(!$verific)
      {
        $registro=new UniAlu;
        $registro->UNI_id=$id;
        $registro->ALU_id=$alumno->ALU_id;
        $registro->save();
      }
      return view('Alumno.Curso.final')
      ->with('alumno',$alumno)
      ->with('pregunta',$pregunta)
      ->with('i',$i)
      ->with('p',$p)
      ->with('div',$div)
      ->with('iddd',$iddd)
      ->with('num',$num)
      ->with('respuesta',$respuesta)
      ->with('unidad',$unidad);
    }
    public function examenprueba($id)
    {
      $iduseralumno = Auth::user()->id;
      $alumno=Alumno::where('USE_id', $iduseralumno)->first();
      $unidad=Unidad::find($id);
      $i=1;
      $p=1;
      $totall=1;
      $iddd=1;
      $num=1;
      $div=1;
      $pregunta=Pregunta::inRandomOrder()->select('*')->where('UNI_id','=',$id)->limit(10)->get();
      $respuesta=Respuesta::inRandomOrder()->get();

      return view('Alumno.Curso.prueba')
       ->with('alumno',$alumno)
      ->with('pregunta',$pregunta)
      ->with('i',$i)
      ->with('p',$p)
      ->with('totall',$totall)
      ->with('div',$div)
      ->with('iddd',$iddd)
      ->with('num',$num)
      ->with('respuesta',$respuesta)
      ->with('unidad',$unidad);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function detalleunidad($id)
    {
      $unidad = Unidad::find($id);
      $iduseralumno = Auth::user()->id;
      $alumno = Alumno::where('USE_id', $iduseralumno)->first();

      $idalum = ($alumno->ALU_id);

      $final = Examen::where('ALU_id','=',$idalum)->where('TIP_id','=',4)->get();
      $prueba = Examen::where('ALU_id','=',$idalum)->where('TIP_id','=',3)->get();
      $p = 1;
      $f = 1;

      return view('Alumno.Curso.detalleunidad')
      ->with('final',$final)
      ->with('f',$f)
      ->with('p',$p)
      ->with('id',$id)
      ->with('unidad',$unidad)
      ->with('prueba',$prueba);
    }
}
