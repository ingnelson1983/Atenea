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
                        

            </tr>
      </thead>


      <tbody>
                <!-- row 1 -->
        @foreach ($salidas as $salida)
            <tr>
                <td> {{ $salida->proy_id_origen }}</td>
                <td> {{ $salida->fecha_Salida }}</td>
                <td> {{ $salida->nom_material }}</td>
                <td> {{ $salida->unidad_medida }}</td>
                <td> {{ $salida->cantidad }}</td>
                <td> {{ $salida->destino }}</td>
                <td> {{ $salida->descripcion }}</td>
                <td> {{ $salida->estado }}</td>
                


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