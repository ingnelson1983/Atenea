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
            <th>Aprobar Almacenista</th>

                        

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
                <td> {{ $salida->estado }}</td>
                
                                
                <td> 
                  <a href="{{route('salida.edit', $salida->id)}}">
                      <svg xmlns="http://www.w3.org/2000/svg" width="15px" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                          <path strokeLinecap="round" strokeLinejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                        </svg>
                      </a>
                  </td>     
                  <td> 

                    @if (auth()->user()->rol->nombre == 'admin')
                      <form action="{{route('salida.destroy', $salida->id)}}" method="post">
                              @csrf
                              @method('DELETE')
                              <BUTTon type="submit">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="15px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                  </svg>
                          </BUTTon>
                      </form>
                      @endif
                  </td>     


                

                  <td> 

                    @if (auth()->user()->rol->nombre == 'admin')
                      <form action="{{route('salidas.aprobar.almacenista', $salida->id)}}" method="post">
                              @csrf
                              @method('put')
                              @if ($salida->estado == "Generado")
                               <input type="hidden" id="estado" name="estado" value="aprobado">
                              @else
                                <input type="hidden" id="estado" name="estado" value="Generado">
                              @endif
                              <BUTTon type="submit">
                                @if ($salida->estado == "Generado")
                                  <svg xmlns="http://www.w3.org/2000/svg" width="15px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                  </svg>
                               @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="15px" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                                  <path strokeLinecap="round" strokeLinejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                </svg>
                               @endif

                          </BUTTon>
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
@endsection