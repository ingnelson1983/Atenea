
@extends('adminlte::page')

@section('title','content_header')

@section('content_header')
    <h1 class="m-0 text-dark">CREAR SALIDA</h1>
@stop

@section('content')


    <p> Ingrese la información de la salida</p>


    <form action="{{route('salidasinsinco.store')}}" method="POST">
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
<textarea name="nom_material" id="nom_material" cols="5" rows="5">{{ old('nom_material')}}</textarea>

    {{-- With prepend slot --}}

    @if ($errors->has('nom_material'))
            <div class="badge badge-warning gap-2">
            <p>{{$errors->first('nom_material')}}</p>
            </div>
    @endif
</div>

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
<a class="btn btn-outline my-4" href="{{route('salida.indexsinsinco')}}">Cancelar</a>
</form>


@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

@endsection


@section('js')

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(".js-example-tags").select2({
    tags: true
  });
  </script>
<script>
    $('#nom_material').summernote({
        placeholder: 'Liste Materiales, Cantidades y Unidad de Medida..',
        tabsize:0,
        height:100
    });
</script>
@endsection