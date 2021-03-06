<?php

namespace SimulatorENUF\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use SimulatorENUF\Models\Curso;
use SimulatorENUF\Models\Unidad;
use SimulatorENUF\Models\CurAlu;
use SimulatorENUF\Models\UniAlu;
use SimulatorENUF\Models\Alumno;
use SimulatorENUF\Models\Profesor;
use DB;
use SimulatorENUF\User;
use SimulatorENUF\Models\Examen;
use Flash;




class ProCursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foto = Auth::user()->foto;
        $idd = Auth::user()->id;
        $profe = Profesor::select('*')->where('USE_id','=',$idd)->get();
        foreach ($profe as $pro)
        {
            $idprofe=$pro->PRO_id;
        }
        $curso = Curso::select('*')->where('PRO_id','=',$idprofe)->get();
        return view('Profesor.Curso.index')
        ->with('curso',$curso);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $curso=Curso::find($id);
      $numero=$curso->CUR_cupos;
      $b=0;
      $cupos=0;
      $aprobado=CurAlu::select('*')
      ->where('CUR_id','=',$curso->CUR_id)
      ->where('CUAL_estatus','=','aprobado')
      ->join('alumnos','alumnos.ALU_id','=','cur_alus.ALU_id')
      ->join('users','users.id','=','alumnos.USE_id')
      ->get();

      foreach($aprobado as $app)
      {
        $b++;
      }
      $cupos=$numero-$b;
      $pendiente=CurAlu::select('*')
      ->where('CUR_id','=',$curso->CUR_id)
      ->where('CUAL_estatus','=','pendiente')
      ->join('alumnos','alumnos.ALU_id','=','cur_alus.ALU_id')
      ->join('users','users.id','=','alumnos.USE_id')
      ->get();
      $verificar=CurAlu::select('*')
      ->where('CUR_id','=',$curso->CUR_id)
      ->join('alumnos','alumnos.ALU_id','=','cur_alus.ALU_id')
      ->join('users','users.id','=','alumnos.USE_id')
      ->get();
      $denegado=CurAlu::select('*')
      ->where('CUR_id','=',$curso->CUR_id)
      ->where('CUAL_estatus','=','denegado')
      ->join('alumnos','alumnos.ALU_id','=','cur_alus.ALU_id')
      ->join('users','users.id','=','alumnos.USE_id')
      ->get();
      $a=1;

      $unidad = Unidad::select('*')->where('CUR_id','=',$id)->get();
      return view('Profesor.Curso.show')
      ->with('curso',$curso)
      ->with('pendiente',$pendiente)
      ->with('denegado',$denegado)
      ->with('aprobado',$aprobado)
      ->with('verificar',$verificar)
      ->with('a',$a)
      ->with('cupos',$cupos)
      ->with('unidad',$unidad);
    }

    public function detallecurso($id)
    {
        $list = CurAlu::select('*')
      ->where('cur_alus.CUR_id', '=',$id )
      ->join('alumnos','alumnos.ALU_id','=','cur_alus.ALU_id')
      #->join('cursos','cursos.CUR_id','=','cur_alus.CUR_id')
      ->get();

      $deta = CurAlu::where('CUR_id',$id)->get();
      $total=0;

      $unidad=Unidad::where('CUR_id','=',$id)
      #->join('uni_alus','uni_alus.UNI_id','unidads.UNI_id')
      ->get();
      $a=0;
      foreach($unidad as $uni)
      {
        $a++;
      }
        $total=($a+1)*10;
      $aa=1;
      $np=1;
      $alusuni=UniAlu::all();
      $curso=Curso::find($id);
      return view('Profesor.Curso.lista')
      ->with('list',$list)
      ->with('deta',$deta)
      ->with('a',$a)
      ->with('np',$np)
      ->with('aa',$aa)
      ->with('total',$total)
      ->with('alusuni',$alusuni)
      ->with('unidad',$unidad)
      ->with('curso',$curso);
    }

    public function listapdf($id)
    {
         $list = CurAlu::select('*')
      ->where('cur_alus.CUR_id', '=',$id )
      ->join('alumnos','alumnos.ALU_id','=','cur_alus.ALU_id')
      #->join('cursos','cursos.CUR_id','=','cur_alus.CUR_id')
      ->get();
      $total=0;
      $deta = CurAlu::where('CUR_id',$id)->get();


      $unidad=Unidad::where('CUR_id','=',$id)
      #->join('uni_alus','uni_alus.UNI_id','unidads.UNI_id')
      ->get();
      $a=0;
      foreach($unidad as $uni)
      {
        $a++;
      }
      $total=($a+1)*10;
      $aa=1;
      $np=1;

      $alusuni=UniAlu::all();
      $curso=Curso::find($id);
      $pdf = \PDF::loadView('Profesor.Curso.pdf',[
        'id' => $id,
        'list' => $list,
        'deta' => $deta,
        'a' => $a,
        'aa' => $aa,
        'np' => $np,
        'alusuni' => $alusuni,
        'unidad' => $unidad,
        'curso' => $curso,
        'total' => $total,
        ]);
      return $pdf->download('Lista.pdf');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }
    public function veralumno($id, $curso)
    {

      $alumno = Alumno::find($id);
      $user = User::find($alumno->USE_id);
      $unidades = Unidad::where("CUR_id", "=", $curso)->get();
      $unidad = Unidad::where("CUR_id", "=", $curso)->count();
      $final = Examen::where('ALU_id','=',$id)->where('TIP_id','=',4)->get();
      $prueba = Examen::where('ALU_id','=',$id)->where('TIP_id','=',3)->get();
      $global = Examen::where('ALU_id','=',$id)->where('TIP_id','=',5)->get();


      return view('Profesor.Curso.veralumno')
      ->with('user',$user)
      ->with('curso',$curso)
      ->with('unidades',$unidades)
      ->with('unidad',$unidad)
      ->with('final',$final)
      ->with('prueba',$prueba)
      ->with('global',$global)
      ->with('alumno',$alumno);

    }

    public function updatepasswordalu(Request $request, $id)
    {
      $this->validate($request,[
        'password' => 'required|min:3|confirmed',
        'password_confirmation' => 'required|min:3'
        ]);
      $user=User::find($id);
      $user->password=bcrypt($request->password);
      if($user->save()){
        Flash::success("Contraseña cambiada, de manera exitosa")->important();;
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

        $cur= CurAlu::find($id);
        $cur ->CUAL_estatus=($request->status);
        $cur->save();
        return redirect()->route('curso.show', ($request->curso));
    }

    public function updateexamenglobal(Request $request, $id){

       $cur= Curso::find($id);
        $cur ->CUR_estatus_examen=($request->status);
        $cur->CUR_fecha_inicio=($request->fechainicio);
        $cur->CUR_fecha_final=($request->fechafinal);
        $cur->CUR_tiempo=($request->tiempo);
        $cur->CUR_numero_preguntas=($request->numero);
        $cur->save();
        return redirect()->route('curso.show', ($id));
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
}
