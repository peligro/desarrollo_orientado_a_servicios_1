<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User as User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccesoController extends Controller
{
    public function login()
    {
        return view('acceso.login');
    }
    public function login_post(Request $request)
    {
        
        $this->validate
        (
        	$request,
        	[
        		'correo'=>'required|email',
        		'pass'=>'required'
        	],
        	[
        		'correo.required'=>'El campo E-Mail está vacío',
        		'correo.email'=>'El E-Mail ingresado no tiene un formato válido',
        		'pass.required'=>'El campo Contraseña está vacío',
        	]
        );
        $credentials = $request->only($request->input('correo'), $request->input('pass'));
        //dd($credentials);
        //if (Auth::attempt($credentials)) {
        if (Auth::attempt(['email' => $request->input('correo'), 'password' => $request->input('pass')]))   
        	{
            // Authentication passed...
            return redirect()->intended('/');
        }else
        {
        	$request->session()->flash('css', 'danger');
        $request->session()->flash('mensaje', 'Los datos ingresados no son correctos');
        return redirect('/acceso/login');
        }
    }
    public function logueado()
    {
        if (Auth::check()) {
            return view('acceso.logueado');
        }else
        {
        	//return "no no";
        	return redirect('/acceso/login');
        }

        
    }
    public function registro()
    {
        return view('acceso.registro');
    }
    public function registro_post(Request $request)
    {
    	$this->validate
        (
        	$request,
        	[
        		'nombre'=>'required|max:255',
        		'correo'=>'required|email|unique:users,email',
        		'pass'=>'required|min:6|confirmed'
        	],
        	[
        		'nombre.required'=>'El campo Nombre está vacío',
        		'correo.required'=>'El campo E-Mail está vacío',
        		'correo.email'=>'El E-Mail ingresado no tiene un formato válido',
        		'correo.unique'=>'El E-Mail ingresado ya está siendo usado por otro usuario',
        		'pass.required'=>'El campo Contraseña está vacío',
        		'pass.confirmed'=>'Las contraseñas ingresadas no coiciden',
        	]
        );
        User::create([
            'name' => $request->input('nombre'),
            'email' => $request->input('correo'),
            'password' => bcrypt($request->input('pass')),
        ]);
        $request->session()->flash('css', 'success');
        $request->session()->flash('mensaje', 'Se ha agregado el registro exitosamente');
        return redirect('/acceso/registro');
    }
    public function salir(Request $request)
    {
        Auth::logout();
        $request->session()->flash('css', 'success');
        $request->session()->flash('mensaje', 'Haz cerrado sesión exitosamente');
        return redirect('/acceso/login');
    }
}