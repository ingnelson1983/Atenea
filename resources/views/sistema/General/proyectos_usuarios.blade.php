

@extends('adminlte::page')

@section('title','content_header')

@section('content_header')
    <h1 class="m-0 text-dark">ADMINISTRACION DE ROLES</h1>
@stop

@section('content')

{{-- En este select el evento Onchange, lo que hace es llamar la Url. This.value, es el id del usuario que se seleeciona en el select--}}
<select name="select_user" id="select_user" class="form-control"  onchange="window.location.href = '/usuario/proyectos/'+this.value+''">
    <option value="">Seleccione un usuario</option>
   {{-- Cuando se eestan listando todos los usuarios en el combobox, cada uno va  a quedar almacenado en la variable user, cuando se recorre --}}
    @foreach ($usuarios as $user)
        {{--si existe un usuario con ese mismo id, lo selecciona del combobox--}}
        @if ($usuario && $usuario->id==$user->id)
          <option value="{{$user->id}}" selected>{{$user->name}}</option>
        @else
          <option value="{{$user->id}}">{{$user->name}}</option>
        @endif


    @endforeach
</select>
@if ($usuario)
    <form action="{{route('asignarProyectosUsuario', $usuario)}}" method="post">
    @csrf
    <table class="table table-zebra w-1/2" >
        <thead>
            <tr>
                <td>Nombre Proyecto</td>
                <td>Codigo proyecto Sinco</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
        {{-- Aca traemos todos los proyectos,  de la tabla proyectos que nos pasa el controlador --}}
        @foreach ($proyectos as $proyecto)
            <tr>
                {{-- Aca llamamos de cada uno de los proyectos el nombre y el codigo en sinco --}}
                <td>{{$proyecto->Nombre_Proyecto}}</td>
                <td>{{$proyecto->Cod_Proyecto_Sinco}}</td>
                <td>
                    @if ($usuario->proyectos->contains($proyecto))
                        {{-- Se crea un arreglo de check box, llamado proyectos []--}}    
                        <input class="checkbox checkbox-primary checkbox-sm" type="checkbox" name="proyectos[]" value="{{$proyecto->id}}" checked>
                    @else
                        <input class="checkbox checkbox-primary checkbox-sm" type="checkbox" name="proyectos[]" value="{{$proyecto->id}}">
                    @endif
                
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <button class="btn btn-neutral m-4" type="submit">Asociar</button>
    </form>
@endif
@stop

@section('css')

@endsection


@section('js')


@endsection



