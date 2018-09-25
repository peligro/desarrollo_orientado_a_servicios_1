<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Usuarios as Usuarios;
use App\User as User;
use Illuminate\Http\Request;
class UsuariosController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
        	$datos = Usuarios::orderBy('id', 'desc')->paginate(10);
            return view('usuarios.index',compact('datos'));
        }else
        {
            return redirect('/acceso/login');
        }
    }
    public function add()
    {
        if (Auth::check()) {
        	return view('usuarios.add');
        }else
        {
            return redirect('/acceso/login');
        }
    }
    public function add_post(Request $request)
    {
        if (Auth::check()) {
        	
        		//se crea el usuarios
$this->validate
        (
        	$request,
        	[
        		'nombre'=>'required|max:255',
        		'correo'=>'required|email|unique:users,email',
        		'telefono'=>'required|max:255',
        		'rut'=>'required|valida_rut',
        		'pass'=>'required|min:6|confirmed'
        	],
        	[
        		'nombre.required'=>'El campo Nombre está vacío',
        		'correo.required'=>'El campo E-Mail está vacío',
        		'correo.email'=>'El E-Mail ingresado no tiene un formato válido',
        		'correo.unique'=>'El E-Mail ingresado ya está siendo usado por otro usuario',
        		'telefono.required'=>'El campo Teléfono está vacío',
        		'rut.required'=>'El campo RUT está vacío',
        		'rut.valida_rut'=>'El RUT ingresado no es válido',
        		'pass.required'=>'El campo Contraseña está vacío',
        		'pass.confirmed'=>'Las contraseñas ingresadas no coiciden',
        	]
        );
        $user=User::create([
            'name' => $request->input('nombre'),
            'email' => $request->input('correo'),
            'password' => bcrypt($request->input('pass')),
        ]);
        Usuarios::create([
            'user_id' => $user->id,
            'rut' => $request->input('rut'),
            'telefono' => $request->input('telefono'),
        ]);
        $request->session()->flash('css', 'success');
        $request->session()->flash('mensaje', 'Se ha agregado el registro exitosamente ');
        return redirect('/usuarios');
        		//fin de se crea el usuario
        }else
        {
            return redirect('/acceso/login');
        }
    }
    public function edit($id)
    {
        if (Auth::check()) {
        	$datos = Usuarios::find($id);
        	return view('usuarios.edit',compact('datos'));
        }else
        {
            return redirect('/acceso/login');
        }
    }
    public function edit_post(Request $request,$id)
    {
    	if (Auth::check()) {
        	
        		//se crea el usuarios
    		$this->validate
        (
        	$request,
        	[
        		'nombre'=>'required|max:255|unique:users,email,'.$id,
        		'correo'=>'required|email',
        		'telefono'=>'required|max:255',
        		'rut'=>'required|valida_rut',
        		'pass'=>'confirmed'
        	],
        	[
        		'nombre.required'=>'El campo Nombre está vacío',
        		'correo.required'=>'El campo E-Mail está vacío',
        		'correo.email'=>'El E-Mail ingresado no tiene un formato válido',
        		'correo.unique'=>'El E-Mail ingresado ya está siendo usado por otro usuario',
        		'telefono.required'=>'El campo Teléfono está vacío',
        		'rut.required'=>'El campo RUT está vacío',
        		'rut.valida_rut'=>'El RUT ingresado no es válido',
        		'pass.confirmed'=>'Las contraseñas ingresadas no coiciden',
        	]
        );
        $arreglo = Usuarios::find($id);
        $arreglo->rut       = $request->input('rut');
        $arreglo->telefono      = $request->input('telefono');
        $arreglo->save();
        if(empty($request->input('pass')))
        {
        	$arreglo2 = User::find($arreglo->user_id);
        	$arreglo2->name = $request->input('nombre');
        	$arreglo2->save();
        }else
        {
        	$arreglo2 = User::find($arreglo->user_id);
        	$arreglo2->name = $request->input('nombre');
        	$arreglo2->password = bcrypt($request->input('pass'));
        	$arreglo2->save();
        }
        


        $request->session()->flash('css', 'success');
        $request->session()->flash('mensaje', 'Se ha modificado el registro exitosamente ');
        return redirect('/usuarios');
    		//fin de se crea el usuario
        }else
        {
            return redirect('/acceso/login');
        }
    }
}