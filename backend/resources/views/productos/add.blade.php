@extends('../layouts.frontend')


@section('content')
<ol class="breadcrumb">
  <li><a href="{{route ('index_index')}}">Inicio</a></li>
  <li><a href="{{route ('productos_index')}}">Productos</a></li>
  <li class="active">Agregar Producto</li>
</ol>
    @if(Session::has('mensaje'))
<div class="alert alert-{{ Session::get('css') }}">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ Session::get('mensaje') }}
</div>
@endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>   
        @endforeach
            </ul>
        </div>
    @endif

    <h1>Crear Producto</h1>
    <form method="post" action="{{route ('productos_add_post')}}" name="form">
        {{ csrf_field() }} 
        <div class="form-group">
            <label for="nombre">Categoría</label>
            <select name="categoria" class="form-control" >
                <option value="0">Seleccione.....</option>
                @foreach($categorias as $categoria)
                    <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" />
        </div>
        <div class="form-group">
            <label for="nombre">Precio</label>
            <input type="text" name="precio" class="form-control" onkeypress="return soloNumeros(event)" />
        </div>
        <hr />
        <input type="submit" value="Enviar" class="btn btn-default" />
    </form>
@endsection
