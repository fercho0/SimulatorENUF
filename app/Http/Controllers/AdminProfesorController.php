<?php

namespace SimulatorENUF\Http\Controllers;

use Illuminate\Http\Request;
use SimulatorENUF\Models\Profesor;
use SimulatorENUF\Models\Direccion;
use SimulatorENUF\User;
use Flash;

class AdminProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profesor=Profesor::join('users','users.id','=','profesors.USE_id')->get();

        return view('Administrador.Profesor.index')->with('profesor',$profesor);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Administrador.Profesor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dir=new Direccion;
        $dir->save();
        $idd= Direccion::find($dir->DIR_id);


        #nuevo usuario
        $user=new User;
        $user->name=($request->usuario);
        $user->foto="file.png";
        $user->password=bcrypt($request->usuario);
        $user->type="profesor";
        $user->save();
        $iduser= User::find($user->id);


        /*register Profesor */
        $pro=new Profesor;
        $pro->PRO_nombre=($request->nombre);
        $pro->PRO_apellido_p=($request->apellido_p);
        $pro->PRO_apellido_m=($request->apellido_m);
        $pro->PRO_sexo=($request->sex);
        $pro->USE_id=($iduser->id);
        $pro->DIR_id=($idd->DIR_id);
        $pro->save();


        return redirect()->route('profesores.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profesor=Profesor::find($id);
         return view("Administrador.Profesor.update")->with('profesor',$profesor);
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

      $this->validate($request,[
        'nombre' => 'required|max:255',
        'apellido_p' => 'required|alpha',
        'apellido_m' => 'required|alpha'
        ]);

      $pro=Profesor::find($id);
      $pro->PRO_nombre=($request->nombre);
      $pro->PRO_apellido_p=($request->apellido_p);
      $pro->PRO_apellido_m=($request->apellido_m);
      $pro->PRO_sexo=($request->sex);
      $pro->PRO_estatus=($request->estatus);
      $pro->save();
      Flash::success("Datos actualizados correctamente")->important();
      return redirect()->route('profesores.index');
    }
    public function updatepass(Request $request, $id)
    {
      $this->validate($request,[
        'password' => 'required|min:3|confirmed',
        'password_confirmation' => 'required|min:3'
        ]);
      $user=User::find($id);
      $user->password=bcrypt($request->password);
      if($user->save()){
        Flash::success("Contraseña cambiada, de manera exitosa")->important();
        return redirect()->route('profesores.index');
      }
      else
      {
        Flash::success("Lo sentimos algo salio mal intentelo de nuevo")->important();
        return redirect()->route('profesores.index');
      }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd("Hola soy las destruccion");
    }
}
