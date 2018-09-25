<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Backend - @yield('title')</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('public/css/bootstrap.min.css') }}" />
    </head>
    <body>
        
        
        <div class="container">
            <div class="panel panel-primary">
                <div class="panel-heading">Administrador @guest
                    @else
        Hola {{ Auth::user()->name }} ({{ Auth::user()->id }})
          
        
    
   @endguest</div>
                <div class="panel-body">
                    @guest

                    @else
                    <ul class="nav nav-tabs">
                      <li role="presentation"><a href="{{route('index_index')}}">Inicio</a></li>
                      <li role="presentation"><a href="{{route('usuarios_index')}}">Usuarios</a></li>
                      <li role="presentation"><a href="{{route('categorias_index')}}">Categorías</a></li>
                        <li role="presentation"><a href="{{route('productos_index')}}">Productos</a></li>
                        <li role="presentation"><a href="{{url ('acceso/salir')}}"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></a></li>
                    </ul>
                    @endguest
                    <!--contenido-->
                    @yield('content')
                    <!--/contenido-->
                    
                </div>
            </div>
            
        </div>

        <!--dependencias javascript-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="{{ asset('public/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/js/funciones.js') }}"></script>
        @stack('scripts')
        <!--/dependencias javascript-->
    </body>
</html>