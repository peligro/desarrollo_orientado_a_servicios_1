@extends('../layouts.frontend')


@section('content')
   @guest
    <p>
        no está logueado
    </p> 
   @else
    <p>
        Hola {{ Auth::user()->name }} ({{ Auth::user()->id }})
        <br />
        <a href="{{url ('acceso/salir')}}">Salir</a>
    </p>
   @endguest
@endsection
