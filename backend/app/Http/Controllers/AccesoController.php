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
    
    public function salir(Request $request)
    {
        Auth::logout();
        $request->session()->flash('css', 'success');
        $request->session()->flash('mensaje', 'Haz cerrado sesión exitosamente');
        return redirect('/acceso/login');
    }
}