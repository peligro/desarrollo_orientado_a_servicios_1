@extends('../layouts.frontend')


@section('content')
<ol class="breadcrumb">
  <li><a href="{{route ('index_index')}}">Inicio</a></li>
  <li><a href="{{route ('categorias_index')}}">Categorías</a></li>
  <li class="active">Agregar Categoría</li>
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

    <h1>Crear Categoría</h1>
    <form method="post" action="{{route ('categorias_add_post')}}" name="form">
        {{ csrf_field() }} 
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" />
        </div>
        
        <hr />
        <input type="submit" value="Enviar" class="btn btn-default" />
    </form>
@endsection
