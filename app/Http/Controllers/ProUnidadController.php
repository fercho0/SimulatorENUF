<?php

namespace SimulatorENUF\Http\Controllers;

use Illuminate\Http\Request;
use SimulatorENUF\Models\Unidad;
use SimulatorENUF\Models\Curso;
use SimulatorENUF\Models\Pregunta;
use SimulatorENUF\Models\Respuesta;
use Flash;

class ProUnidadController extends Controller
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
    public function store(Request $request)
    {
        if($request->file('file'))
        {
            $file=$request->file('file');
            $nombreapoyo = 'documento_'.time().'.'.$file->getClientOriginalExtension();
            $path=public_path().'/files/documents';
            $file->move($path, $nombreapoyo);
        }
        else
        {
            $nombreapoyo=null;
        }
      $unidad=new Unidad;
      $unidad->UNI_nombre=($request->nombre);
      $unidad->UNI_material_apoyo=$nombreapoyo;
      $unidad->UNI_fecha_final=($request->fecha);
      $unidad->UNI_fecha_inicio=($request->fecha_inicio);
      $unidad->UNI_tiempo=($request->tiempo);
      $unidad->UNI_numero_pregunta=($request->numero);
      $unidad->CUR_id=($request->curso);
      $unidad->save();
      return redirect()->route('curso.show', ($request->curso));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $unidad=Unidad::find($id);
      $idcurso=$unidad->CUR_id;
      $curso=Curso::find($idcurso);
      $count=1;
      $pregunta=Pregunta::select('*')->where('UNI_id','=',$id)->get();
      $respuesta=Respuesta::all();
      return view("Profesor.Unidad.show")
      ->with('curso',$curso)
      ->with('count',$count)
      ->with('pregunta',$pregunta)
      ->with('respuesta',$respuesta)
      ->with('unidad',$unidad);
    }

    public function showunidad($id, $curso)
    {
      $unidad=Unidad::find($id);
      return view("Profesor.Unidad.showunidad")
      ->with('curso',$curso)
      ->with('unidad',$unidad);

    }
    public function edit($id)
    {
      $pregunta=Pregunta::find($id);
      $respuesta=Respuesta::where('PRE_id','=',$id)->get();
      $con=1;
      $con2=1;
      $con3=1;
      $con4=1;
      return view("Profesor.Unidad.editpregunta")
      ->with('pre',$pregunta)
      ->with('con',$con)
      ->with('con2',$con2)
      ->with('con3',$con3)
      ->with('con4',$con4)
      ->with('res',$respuesta);
    }

    public function updateunidad(Request $request, $id)
    {
      if($request->file('file'))
        {
            $file=$request->file('file');
            $nombreapoyo = 'documento_'.time().'.'.$file->getClientOriginalExtension();
            $path=public_path().'/files/documents';
            $file->move($path, $nombreapoyo);
        }
        else
        {
            $nombreapoyo=null;
        }
      $unidad=Unidad::find($id);
      $unidad->UNI_nombre=($request->nombre);
      $unidad->UNI_material_apoyo=$nombreapoyo;
      $unidad->UNI_fecha_final=($request->fecha_final);
      $unidad->UNI_fecha_inicio=($request->fecha_de_inicio);
      $unidad->UNI_tiempo=($request->tiempo);
      $unidad->UNI_numero_pregunta=($request->numero);
      if($unidad->save()){
        Flash::success("Unidad actualizada, de manera exitosa")->important();;
        return redirect()->route('curso.show', ($request->curso));
      }
      else
      {
        Flash::success("Lo sentimos algo salio mal intentelo de nuevo")->important();;
        return redirect()->route('curso.show', ($request->curso));
      }
    }

    public function update(Request $request, $id)
    {
        $pregunta=Pregunta::find($id);
        if($request->file('file'))
        {
            $file=$request->file('file');
            $nombrefile = 'foto_'.time().'.'.$file->getClientOriginalExtension();
            $path=public_path().'/files/documents';
            $file->move($path, $nombrefile);

            $pre=Pregunta::find($id);
          $pre->PRE_nombre=($request->Pregunta);
          $pre->PRE_file=$nombrefile;
          $pre->save();
        }
        else
        {
          $pre=Pregunta::find($id);
          $pre->PRE_nombre=($request->Pregunta);
          $pre->save();
        }


        if($pre)
        {
          for($a=1;$a<5;$a++)
        {
          $idres='idres'.$a;
          $res="res".$a;
          $tip="tipo".$a;
          $pre=Respuesta::find($request->$idres);
          $pre->RES_nombre=($request->$res);
          $pre->TIP_id=($request->$tip);
          $pre->save();
        }
        Flash::success("Pregunta actualizada correctamente")->important();
        return redirect()->route('unidad.show', ($pregunta->UNI_id));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {

      $res=Respuesta::where('PRE_id',$id)->get();
      foreach($res as $re)
      {
        $borrar=Respuesta::find($re->RES_id);
        $borrar->delete();
      }

      $res=Pregunta::find($id);
      $res->delete();

      return redirect()->route('unidad.show', ($request->unidad));

    }
}
