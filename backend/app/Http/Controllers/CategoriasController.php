<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Categorias;
use Illuminate\Http\Request;
class CategoriasController extends Controller
{
    
    public function index()
    {
        if (Auth::check()) 
        {
            $datos = Categorias::orderBy('id', 'desc')->paginate(10);
            return view('categorias.index',compact('datos'));
        }else
        {
            return redirect('/acceso/login');
        }

    }
    public function add()
    {
        if (Auth::check()) 
        {
            return view('categorias.add');
        }else
        {
            return redirect('/acceso/login');
        }

    }
    public function add_post(Request $request)
    {
        if (Auth::check()) 
        {
            //se crea
        $this->validate
        (
            $request,
            [
                'nombre'=>'required|max:255|unique:categorias,categoria',
            ],
            [
                'nombre.required'=>'El campo Nombre está vacío',
                'nombre.unique'=>'El nombre ingresado ya está siendo usado por otra categoría',
            ]
        );
        Categorias::create([
            'categoria' => $request->input('nombre'),
            'slug' => str_slug($request->input('nombre'), '-'),
        ]);
        
        $request->session()->flash('css', 'success');
        $request->session()->flash('mensaje', 'Se ha agregado el registro exitosamente ');
        return redirect('/categorias');
                //fin de se crea
        }else
        {
            return redirect('/acceso/login');
        }
    }
    public function edit($id)
    {
        if (Auth::check()) 
        {
            $datos = Categorias::find($id);
            return view('categorias.edit',compact('datos'));
        }else
        {
            return redirect('/acceso/login');
        }

    }
    public function edit_post(Request $request,$id)
    {
        if (Auth::check()) {
                $this->validate
                (
                    $request,
                    [
                        'nombre'=>'required|max:255|unique:categorias,categoria,'.$id,
                    ],
                    [
                        'nombre.required'=>'El campo Nombre está vacío',
                        'nombre.unique'=>'El nombre ingresado ya está siendo usado por otra categoría',
                    ]
                );
                $arreglo = Categorias::find($id);
                $arreglo->categoria       = $request->input('nombre');
                $arreglo->slug      = str_slug($request->input('nombre'), '-');
                $arreglo->save();
                $request->session()->flash('css', 'success');
                $request->session()->flash('mensaje', 'Se ha modificado el registro exitosamente ');
                return redirect('/categorias');
        }else
        {
            return redirect('/acceso/login');
        }
    }
    public function delete(Request $request,$id)
    {
        if (Auth::check()) {
              if(Categorias::find($id) and is_numeric($id))
              {
                if(Categorias::all())
                {
                    $arreglo = Categorias::find($id);
                    $arreglo->delete();
                    $request->session()->flash('css', 'success');
                    $request->session()->flash('mensaje', 'Se ha eliminado el registro exitosamente ');
                    return redirect('/categorias');
                }else
                {
                    $request->session()->flash('css', 'danger');
                    $request->session()->flash('mensaje', 'No se puede eliminar este registro porque está siendo utilizado. ');
                    return redirect('/categorias');
                }
                
              }else
              {
                abort(404);
              }
              
              
        }else
        {
            return redirect('/acceso/login');
        }
    }
}