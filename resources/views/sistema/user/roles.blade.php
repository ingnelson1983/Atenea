
@extends('adminlte::page')

@section('title','content_header')

@section('content_header')
    <h1 class="m-0 text-dark">ADMINISTRACION DE ROLES</h1>
@stop

@section('content')
    <p> Ingrese la información de la salida</p>


    <form action="{{route('salida.store')}}" method="POST">
        @csrf
{{-- With append slot, number type, and sm size --}}
<x-adminlte-input name="id_usu" label="Id Usuario" placeholder="Ingrese Aqui el Id del usuario" type="number" label-class="text-lightblue"
    igroup-size="sm" min=1 max=10>
    <x-slot name="prependSlot">
        <div class="input-group-text">
            <i class="fas fa-hashtag text-lightblue"></i>
        </div>
    </x-slot>
</x-adminlte-input>


{{-- With append slot, number type, and sm size --}}
<x-adminlte-input name="proy_id_origen" label="Proyecto Origen" placeholder="Seleccione el Proyecto" type="number" label-class="text-lightblue"
    igroup-size="sm" min=1 max=10>
    <x-slot name="prependSlot">
        <div class="input-group-text">
            <i class="fas fa-hashtag text-lightblue"></i>
        </div>
    </x-slot>
</x-adminlte-input>


{{-- With prepend slot --}}
<x-adminlte-input name="fecha_Salida" label="Fecha Salida" placeholder="Fecha de Salida" label-class="text-lightblue">
    <x-slot name="prependSlot">
        <div class="input-group-text">
            <i class="fas fa-user text-lightblue"></i>
        </div>
    </x-slot>
</x-adminlte-input>

{{-- With prepend slot --}}
<x-adminlte-input name="cod_material_sinco" label="Cod Material Sinco" placeholder="Cod Material Sinco" label-class="text-lightblue">
    <x-slot name="prependSlot">
        <div class="input-group-text">
            <i class="fas fa-user text-lightblue"></i>
        </div>
    </x-slot>
</x-adminlte-input>


{{-- With prepend slot --}}
<x-adminlte-input name="nom_material" label="Nom Material Sinco" placeholder="Nom Material Sinco" label-class="text-lightblue">
    <x-slot name="prependSlot">
        <div class="input-group-text">
            <i class="fas fa-user text-lightblue"></i>
        </div>
    </x-slot>
</x-adminlte-input>


{{-- With prepend slot --}}
<x-adminlte-input name="unidad_medida" label="Unidad de Medida" placeholder="Unidad de Medida" label-class="text-lightblue">
    <x-slot name="prependSlot">
        <div class="input-group-text">
            <i class="fas fa-user text-lightblue"></i>
        </div>
    </x-slot>
</x-adminlte-input>

{{-- With append slot, number type, and sm size --}}
<x-adminlte-input name="cantidad" label="Cantidad" placeholder="Cantidad" type="number" label-class="text-lightblue"
    igroup-size="sm" min=1 max=10>
    <x-slot name="prependSlot">
        <div class="input-group-text">
            <i class="fas fa-hashtag text-lightblue"></i>
        </div>
    </x-slot>
</x-adminlte-input>


{{-- With prepend slot --}}
<x-adminlte-input name="destino" label="Destino" placeholder="Destino" label-class="text-lightblue">
    <x-slot name="prependSlot">
        <div class="input-group-text">
            <i class="fas fa-user text-lightblue"></i>
        </div>
    </x-slot>
</x-adminlte-input>

{{-- With prepend slot --}}
<x-adminlte-input name="descripcion" label="Descripcion" placeholder="Descripcion" label-class="text-lightblue">
    <x-slot name="prependSlot">
        <div class="input-group-text">
            <i class="fas fa-user text-lightblue"></i>
        </div>
    </x-slot>
</x-adminlte-input>

{{-- With prepend slot --}}
<x-adminlte-input name="estado" label="Estado" placeholder="Estado" label-class="text-lightblue">
    <x-slot name="prependSlot">
        <div class="input-group-text">
            <i class="fas fa-user text-lightblue"></i>
        </div>
    </x-slot>
</x-adminlte-input>


<x-adminlte-button type="submit" label="Guardar" theme="primary" icon="fas fa-save"/>
<a class="btn btn-outline my-4" href="{{route('salida.index')}}">Cancelar</a>
</form>


@stop

@section('css')

@endsection


@section('js')


@endsection