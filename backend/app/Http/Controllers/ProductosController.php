<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Categorias;
use App\Productos;
use Illuminate\Http\Request;
class ProductosController extends Controller
{
    public function __construct()
    {
        $this->middleware('acceso');
    }
    public function index()
    {
        $datos = Productos::orderBy('id', 'desc')->paginate(10);
        return view('productos.index',compact('datos'));
    }
    public function add()
    {
        $categorias=Categorias::all();
        return view('productos.add',compact('categorias'));
    }
    public function add_post(Request $request)
    {
        //se crea
        $this->validate
        (
            $request,
            [
                'categoria'=>'valida_select',
                'nombre'=>'required|max:255|unique:productos,nombre',
                'precio'=>'required|numeric',
            ],
            [
                'nombre.required'=>'El campo Nombre está vacío',
                'nombre.unique'=>'El nombre ingresado ya está siendo usado por otro producto',
                'precio.required'=>'El campo Precio está vacío',
                'precio.numeric'=>'El campo precio sólo debe contener números',
                'categoria.valida_select'=>'Debe seleccionar una opción en el campo Categorías',
            ]
        );

        Productos::create([
            'categoria_id' => $request->input('categoria'),
            'nombre' => $request->input('nombre'),
            'slug' => str_slug($request->input('nombre'), '-'),
            
            'precio' => $request->input('precio'),
            
        ]);
        
        $request->session()->flash('css', 'success');
        $request->session()->flash('mensaje', 'Se ha agregado el registro exitosamente ');
        return redirect('/productos');
        //fin de se crea
    }
    public function edit($id)
    {
        $datos = Productos::find($id);
        $categorias=Categorias::all();
        return view('productos.edit',compact('datos','categorias'));
    }
    public function edit_post(Request $request,$id)
    {
        
                $this->validate
                (
                    $request,
                    [
                        'categoria'=>'valida_select',
                        'nombre'=>'required|max:255|unique:productos,nombre,'.$id,
                        'precio'=>'required|numeric',
                    ],
                    [
                        'nombre.required'=>'El campo Nombre está vacío',
                        'nombre.unique'=>'El nombre ingresado ya está siendo usado por otro producto',
                        'precio.required'=>'El campo Precio está vacío',
                        'precio.numeric'=>'El campo precio sólo debe contener números',
                        'categoria.valida_select'=>'Debe seleccionar una opción en el campo Categorías',
                    ]
                );
                $arreglo = Productos::find($id);
                $arreglo->categoria_id      = $request->input('categoria');
                $arreglo->nombre      = $request->input('nombre');
                $arreglo->precio      = $request->input('precio');
                $arreglo->slug      = str_slug($request->input('nombre'), '-');
                $arreglo->save();
                $request->session()->flash('css', 'success');
                $request->session()->flash('mensaje', 'Se ha modificado el registro exitosamente ');
                return redirect('/productos');
        
    }
    public function delete(Request $request,$id)
    {
        
              if(Productos::find($id) and is_numeric($id))
              {
                $arreglo = Productos::find($id);
                $arreglo->delete();
                $request->session()->flash('css', 'success');
                $request->session()->flash('mensaje', 'Se ha eliminado el registro exitosamente ');
                return redirect('/productos');
                
              }else
              {
                abort(404);
              }
    }
}