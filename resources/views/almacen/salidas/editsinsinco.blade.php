
@extends('adminlte::page')

@section('title','content_header')

@section('content_header')
    <h1 class="m-0 text-dark">EDITAR SALIDA</h1>
@stop

@section('content')
    <p> Ingrese la información de la salida</p>

{{-- shadow-lg = Pone una sombra m-8 = pone un margen extrerno al div--}}
<div class="flex flex-row  min-h-screen justify-center items-center m-8 shadow-lg p-4">
       
        <form action="{{route('salida.updatesinsinco', $salida->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div>
                        <input type="hidden" name="id_usu" value="{{$salida->id_usu}}">
                </div>

                <div>
                <x-adminlte-select-bs name="proyecto_id" for="proyecto_id"  id="proyecto_id"  label="Proyecto"  label-class="text-lightblue"
                igroup-size="lg"  data-live-search
                data-live-search-placeholder="Search..." data-show-tick>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-car-side"></i>
                    </div>
                </x-slot>
        </div>

            @foreach ($proyectos_usuario as $proyecto)
                @if  ($salida->proyecto->id == $proyecto->id)
                        <option value="{{$proyecto->id}}" class="input input-bordered input-info w-full max-w-xs" selected>{{$proyecto->Nombre_Proyecto}}</option>
                @else
                        <option value="{{$proyecto->id}}" class="input input-bordered input-info w-full max-w-xs">{{$proyecto->Nombre_Proyecto}}</option>
                @endif        
            @endforeach
        </x-adminlte-input>
        


                <div>

                        <div>
                                <input type="hidden" name="fecha_Salida" value="{{now()}}">
                        </div>

                                @if ($errors->has('fecha_Salida'))
                                        <div class="badge badge-warning gap-2">
                                        <p>{{$errors->first('fecha_Salida')}}</p>
                                        </div>
                                @endif
                </div>

    <div>


        <textarea name="nom_material" id="nom_material" cols="5" rows="5">{{$salida->nom_material}}</textarea>

        @if ($errors->has('nom_material'))
                <div class="badge badge-warning gap-2">
                <p>{{$errors->first('nom_material')}}</p>
                </div>
        @endif
</div>
              
                <div>
                        {{-- With prepend slot --}}
                <x-adminlte-input name="destino" label="Destino" placeholder="Destino" label-class="text-lightblue" value="{{$salida->destino}}">
                        <x-slot name="prependSlot">
                        <div class="input-group-text">
                                <i class="fas fa-user text-lightblue"></i>
                        </div>
                        </x-slot>
                </x-adminlte-input>

                        @if ($errors->has('destino'))
                                <div class="badge badge-warning gap-2">
                                <p>{{$errors->first('destino')}}</p>
                                </div>
                        @endif
                </div>


                <div>
                        {{-- With prepend slot --}}
                <x-adminlte-input name="descripcion" label="descripcion" placeholder="Descripcion" label-class="text-lightblue" value="{{$salida->descripcion}}">
                        <x-slot name="prependSlot">
                        <div class="input-group-text">
                                <i class="fas fa-user text-lightblue"></i>
                        </div>
                        </x-slot>
                </x-adminlte-input>

                        @if ($errors->has('descripcion'))
                                <div class="badge badge-warning gap-2">
                                <p>{{$errors->first('descripcion')}}</p>
                                </div>
                        @endif
                </div>


                <div>

                <input type="hidden" name="estado" value="{{$salida->estado}}">

                        @if ($errors->has('estado'))
                                <div class="badge badge-warning gap-2">
                                <p>{{$errors->first('estado')}}</p>
                                </div>
                        @endif
                </div>



                <button  type="submit" class="btn btn-outline btn-primary my-4">Actualizar</button>
                <a class="btn btn-outline my-4" href="{{route('salida.indexsinsinco')}}">Cancelar</a>
            </form>
    </div>
    
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