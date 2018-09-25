@extends('../layouts.frontend')


@section('content')
<ol class="breadcrumb">
  <li><a href="{{route ('index_index')}}">Inicio</a></li>
  <li><a href="{{route ('usuarios_index')}}">Usuarios</a></li>
  <li class="active">Editar Usuario</li>
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
    
    <h1>Editar usuario</h1>
    <form method="post" action="{{route ('usuarios_edit_post', ['id' => $datos->id])}}" name="form">
        {{ csrf_field() }} 
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{$datos->user->name}}" />
        </div>
        <div class="form-group">
            <label for="correo">E-Mail</label>
            <input type="text" name="correo" class="form-control" value="{{$datos->user->email}}" readonly="true" />
        </div>
        <div class="form-group">
            <label for="nombre">Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="{{$datos->telefono}}" />
        </div>
        <div class="form-group">
            <label for="nombre">RUT</label>
            <input type="text" name="rut" class="form-control" value="{{$datos->rut}}" />
        </div>
        <div class="form-group">
            <label for="pass">Contraseña</label>
            <input type="password" name="pass" class="form-control" />
        </div>
        <div class="form-group">
            <label for="pass2">Repetir Contraseña</label>
            <input type="password" name="pass_confirmation" class="form-control" />
        </div>
        <hr />
        <input type="submit" value="Enviar" class="btn btn-default" />
    </form>
@endsection
