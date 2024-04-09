@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.1/css/responsive.bootstrap5.css">
@endsection


@section('content')



<div class="card">
  <div class="card-body">



    <table  id="tsalidas" class="table table-striped" style="width:100%">
      <!-- head -->
      
      <thead>
            <tr>
            <th>Proyecto Origen</th>
            <th>Fecha Salida</th>
            <th>Material Sinco</th>
            <th>Unidad de Medida</th>
            <th>Cantidad</th>
            <th>Destino</th>
            <th>Descripcion</th>
            <th>Estado</th>
            <th>Editar</th>
            <th>Eliminar</th>                      

            </tr>
      </thead>


      <tbody>
                <!-- row 1 -->
        @foreach ($salidas as $salida)
            <tr>
                <td> {{ $salida->proyecto_id }}</td>
                <td> {{ $salida->fecha_Salida }}</td>
                <td> {{ $salida->descripcionSinco }}</td>
                <td> {{ $salida->unidad_medida }}</td>
                <td> {{ $salida->cantidad }}</td>
                <td> {{ $salida->destino }}</td>
                <td> {{ $salida->descripcion }}</td>
                <td> 
                  @if ($salida->estado == "Generada")
                    <button class="btn btn-warning">Generada</button>
                  @endif
                  @if ($salida->estado == "AprobadaAlmacenista")
                    <button class="btn btn-info">Aprob Almacen</button>
                  @endif
                  @if ($salida->estado == "AprobadaCoordAdm")
                    <button type="button" class="btn btn-success">Aprob Coord Adm</button>
                  @endif
               </td>
                
               @if ($salida->estado == "Generada")              
                <td> 
                  <a href="{{route('salida.edit', $salida->id)}}">
                      <svg xmlns="http://www.w3.org/2000/svg" width="15px" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                          <path strokeLinecap="round" strokeLinejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                        </svg>
                      </a>
                  </td>     

                 @else
                 <td> 
                    <p style="color:#FF0000";>No se puede Editar!</p> 
                 </td> 
                 @endif
                 <td> 
                    @if (auth()->user()->rol->nombre == 'Admin')
                      <form action="{{route('salida.destroy', $salida->id)}}" method="post" class="formulario-eliminar">
                              @csrf
                              @method('DELETE')
                              @if ($salida->estado == "Generada")
                              <BUTTon type="submit">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="15px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                  </svg>
                              </BUTTon>
                              @else
                              <p style="color:#FF0000";>No se puede Eliminar!</p> 
                              @endif
                      </form>
                      @endif
                  </td>     
            </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>


@stop

@section('js')
<script src="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.1/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.1/js/responsive.bootstrap5.js"></script>



<script>
  new DataTable('#tsalidas', {
  responsive: true,
  autoWidth:false
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('eliminar') == 'ok')

<script>
      Swal.fire({
        title: "Eliminada!",
        text: "La salida ha sido Eliminada",
        icon: "success"
      });
</script>
@endif
<script>
  //cuando se trate de enviar el formularioo con la clase,formulario-eliminar haz la siguiente accion. en la letra e, se captura el evento
      $('.formulario-eliminar').submit(function(e){
        e.preventDefault();
    
  Swal.fire({
    title: "Estas Seguro?",
    text: "Esta Salida se eliminará definitivamente",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Eliminar!",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    //aca lo que hace el condicional es validar que opcion eligio el  usuario, true o false. Si es true, entonces
    //envia el formulario, eliminar el registro en el metodo detroy y desde el controlador, nos devuelve dos parametros, los
    //cuales sirven para mostrar el mensaje que fue eliminado correctamente. que se muestra desde la linea 117
    if (result.isConfirmed) {
   
      this.submit();
    }
  });
});
</script>

@endsection