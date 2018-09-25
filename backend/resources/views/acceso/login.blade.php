@extends('../layouts.frontend')


@section('content')
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
    <h1>Ingresa tus datos</h1>
    <form method="post" action="{{url ('acceso/login_post')}}" name="form">
        {{ csrf_field() }} 
        <div class="form-group">
            <label for="correo">E-Mail</label>
            <input type="text" name="correo" class="form-control" />
        </div>
        <div class="form-group">
            <label for="pass">Contraseña</label>
            <input type="password" name="pass" class="form-control" />
        </div>
        <hr />
        <input type="submit" value="Enviar" class="btn btn-default" />
       
    </form>
@endsection
