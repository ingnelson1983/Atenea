
@extends('adminlte::page')

@section('title','content_header')

@section('content_header')
    <h1 class="m-0 text-dark">CREAR SALIDA</h1>
@stop

@section('content')


    <p> Ingrese la información de la salida</p>


    <form action="{{route('salida.store')}}" method="POST">
        @csrf

    <input type="hidden" name="id_usu" value= "{{(auth()->user()->id)}}">

    @if ($errors->has('id_usu'))
    <div class="badge badge-warning gap-2">
        <p>{{$errors->first('id_usu')}}</p>
    </div>
    @endif




    <x-adminlte-select-bs name="proyecto_id" for="proyecto_id"  id="proyecto_id"  label="Proyecto" label-class="text-lightblue"
        igroup-size="lg"  data-live-search
        data-live-search-placeholder="Search..." data-show-tick>
        <x-slot name="prependSlot">
            <div class="input-group-text bg-gradient-info">
                <i class="fas fa-car-side"></i>
            </div>
        </x-slot>

    @foreach ($proyectos_usuario as $proyectos)
    <option value="{{$proyectos->id}}" class="input input-bordered input-info w-full max-w-xs">{{$proyectos->Nombre_Proyecto}}</option>
    @endforeach
</x-adminlte-input>




<input type="hidden" name="fecha_Salida" value="{{ now()  }}">


<div>



    <x-adminlte-select-bs class="js-example-tags" name="cod_material_sinco" for="cod_material_sinco"  id="cod_material_sinco"  label="Material/Producto" onchange="document.getElementById('nom_material').value=this.options[this.selectedIndex].text"> label-class="text-lightblue"
        igroup-size="lg" data-title="Seleccione Material" data-live-search
        data-live-search-placeholder="Search..." data-show-tick>
        <x-slot name="prependSlot">
            <div class="input-group-text bg-gradient-info">
                <i class="fas fa-car-side"></i>
            </div>
        </x-slot>
        <option value="" class="input input-bordered input-info w-full max-w-xs">Seleccione un Material</option>
        @foreach ($materiales as $material)
            <option value="{{$material->ProCod}}" class="input input-bordered input-info w-full max-w-xs">{{$material->ProDesc}}</option>
        @endforeach
    </x-adminlte-select-bs>


</div>


{{-- With prepend slot --}}
<x-adminlte-input type="hidden" name="nom_material" placeholder="Nom Material Sinco" label-class="text-lightblue" value="">

</x-adminlte-input>

<div>
    {{-- With prepend slot --}}

    @if ($errors->has('nom_material'))
            <div class="badge badge-warning gap-2">
            <p>{{$errors->first('nom_material')}}</p>
            </div>
    @endif
</div>






{{-- With prepend slot --}}
<x-adminlte-input name="unidad_medida" label="Unidad de Medida" placeholder="Unidad de Medida" label-class="text-lightblue" value="{{ old('unidad_medida')}}">
    <x-slot name="prependSlot">
        <div class="input-group-text">
            <i class="fas fa-user text-lightblue"></i>
        </div>
    </x-slot>
</x-adminlte-input>

{{-- With append slot, number type, and sm size --}}
<x-adminlte-input name="cantidad" label="Cantidad" placeholder="Cantidad" type="number" label-class="text-lightblue"
    igroup-size="sm" min=1  value="{{ old('cantidad')}}">
    <x-slot name="prependSlot">
        <div class="input-group-text">
            <i class="fas fa-hashtag text-lightblue"></i>
        </div>
    </x-slot>
</x-adminlte-input>


{{-- With prepend slot --}}
<x-adminlte-input name="destino" label="Destino" placeholder="Destino" label-class="text-lightblue" value="{{ old('destino')}}">
    <x-slot name="prependSlot">
        <div class="input-group-text">
            <i class="fas fa-user text-lightblue"></i>
        </div>
    </x-slot>
</x-adminlte-input>

{{-- With prepend slot --}}
<x-adminlte-input name="descripcion" label="Descripcion" placeholder="Descripcion" label-class="text-lightblue" value="{{ old('descripcion')}}">
    <x-slot name="prependSlot">
        <div class="input-group-text">
            <i class="fas fa-user text-lightblue"></i>
        </div>
    </x-slot>
</x-adminlte-input>


<input type="hidden" name="estado" value="Generada">




<x-adminlte-button type="submit" label="Guardar" theme="primary" icon="fas fa-save"/>
<a class="btn btn-outline my-4" href="{{route('salida.index')}}">Cancelar</a>
</form>


@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection


@section('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(".js-example-tags").select2({
    tags: true
  });
  </script>
@endsection