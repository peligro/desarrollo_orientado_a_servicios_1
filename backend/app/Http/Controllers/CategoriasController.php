<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Categorias;
use Illuminate\Http\Request;
class CategoriasController extends Controller
{
    public function __construct()
    {
        $this->middleware('acceso');
    }
    public function index()
    {
        $datos = Categorias::orderBy('id', 'desc')->paginate(10);
        return view('categorias.index',compact('datos'));
    }
    public function add()
    {
        return view('categorias.add');
    }
    public function add_post(Request $request)
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
    }
    public function edit($id)
    {
        $datos = Categorias::find($id);
        return view('categorias.edit',compact('datos'));
    }
    public function edit_post(Request $request,$id)
    {
        
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
        
    }
    public function delete(Request $request,$id)
    {
        
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
              
              
        
    }
}