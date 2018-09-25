@extends('../layouts.frontend')

@section('content')
<br />
 @if(Session::has('mensaje'))
<div class="alert alert-{{ Session::get('css') }}">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ Session::get('mensaje') }}
</div>
@endif
    <p>
    	<a href="{{route ('productos_add')}}" class="btn btn-success">Agregar</a>
    </p>
    <table class="table table-bordered table-striped table-hover">
    	<thead>
    		<tr>
    			<td>ID</td>
                <td>Categoría</td>
    			<td>Nombre</td>
                <td>Precio</td>
    			<td>Acciones</td>
    		</tr>
    	</thead>
    	<tbody>
    		@foreach ($datos as $dato)
							    <tr>
							    	<td>{{$dato->id}}</td>
							    	<td>{{$dato->categoria->categoria}}</td>
                                    <td>{{$dato->nombre}}</td>
                                    <td>${{ number_format($dato->precio, 0,'','.') }}</td>
							    	<td style="text-align: center;">
							    	<a href="{{route('productos_edit', ['id' => $dato->id])}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>	
							    	<a href="javascript:void(0);" onclick="eliminar('{{route('productos_delete', ['id' => $dato->id])}}');"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
							    	</td>
							    </tr>
			@endforeach
    	</tbody>
    </table>
    <p>{{ $datos->links() }}</p>
@endsection