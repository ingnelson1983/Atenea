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

  

    <table  id="tsalidas" class="table table-striped " style="width:90%">
      <!-- head -->
      
      <thead>
            <tr>
              <th style="width:10%">Proyecto</th>
              <th style="width:10%">Fecha Salida</th>
              <th style="width:20%">Material</th>
              <th style="width:20%">Destino</th>
              <th style="width:20%">Descripcion</th>
              <th style="width:10%">Estado</th>
            <th style="width:10%">Aprobar Coord Admin</th>
            
                        

            </tr>
      </thead>


      <tbody>
                <!-- row 1 -->
        @foreach ($salidas as $salida)
            <tr>
                <td> {{ $salida->Proyecto->Nombre_Proyecto }}</td>
                <td> {{ $salida->fecha_Salida }}</td>
                <td> <div> {!! $salida->nom_material !!} </div></td>

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
                     
                 <td> 
                  @if (auth()->user()->rol->nombre == 'Admin')
                    <form action="{{route('Rsalida.aprob.coordadmin', $salida->id)}}" method="post">
                            @csrf
                            @method('put')
                            @if ($salida->estado == "AprobadaAlmacenista")
                             <input type="hidden" id="estado" name="estado" value="AprobadaCoordAdm">
                            @else
                              <input type="hidden" id="estado" name="estado" value="AprobadaAlmacenista">
                            @endif
                          
                              @if ($salida->estado == "AprobadaAlmacenista")
                              <BUTTon type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="25" viewBox="0,0,256,256"
                                style="fill:#228BE6;">
                                <g fill="#228be6" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(9.84615,9.84615)"><path d="M13,0.15625c-7.09766,0 -12.84375,5.74609 -12.84375,12.84375c0,7.09766 5.74609,12.84375 12.84375,12.84375c7.09766,0 12.84375,-5.74609 12.84375,-12.84375c0,-7.09766 -5.74609,-12.84375 -12.84375,-12.84375zM11.96875,3c0.03906,-0.00391 0.08594,0.00391 0.125,0v0.5c0,0.5 0.40625,0.90625 0.90625,0.90625c0.5,0 0.90625,-0.40625 0.90625,-0.90625v-0.5c4.82031,0.42969 8.66406,4.27344 9.09375,9.09375h-0.5c-0.03125,0 -0.0625,0 -0.09375,0c-0.5,0.02734 -0.88672,0.45313 -0.85937,0.95313c0.02734,0.5 0.45313,0.88672 0.95313,0.85938h0.5c-0.42969,4.82031 -4.27344,8.66406 -9.09375,9.09375v-0.5c0.00391,-0.25781 -0.10156,-0.50781 -0.29297,-0.67969c-0.19141,-0.17578 -0.44922,-0.25781 -0.70703,-0.22656c-0.46484,0.04297 -0.82031,0.4375 -0.8125,0.90625v0.5c-4.82031,-0.42969 -8.66406,-4.27344 -9.09375,-9.09375h0.5c0.5,0 0.90625,-0.40625 0.90625,-0.90625c0,-0.5 -0.40625,-0.90625 -0.90625,-0.90625h-0.5c0.42969,-4.78125 4.20313,-8.60937 8.96875,-9.09375zM13,5.4375c-0.49219,0 -0.70312,0.4375 -0.71875,0.6875l-0.28125,5.28125c-0.53516,0.33594 -0.90625,0.91406 -0.90625,1.59375c0,1.04688 0.85938,1.90625 1.90625,1.90625c0.05469,0 0.10156,-0.02734 0.15625,-0.03125l4.25,3.8125c0.19531,0.17188 0.70313,0.32813 1.15625,-0.125c0.45703,-0.45312 0.32422,-0.99219 0.15625,-1.1875l-3.8125,-4.34375c0,-0.01172 0,-0.01953 0,-0.03125c0,-0.70312 -0.39844,-1.29687 -0.96875,-1.625l-0.21875,-5.25c-0.01172,-0.25 -0.23047,-0.6875 -0.71875,-0.6875z"></path></g></g>
                                </svg>
                              </BUTTon>
                              @endif
                                @if ($salida->estado == "AprobadaCoordAdm")
                                <BUTTon type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="25" viewBox="0 0 26 26"
                                style="fill:#228BE6;">
                                <path d="M 13 0.1875 C 5.925781 0.1875 0.1875 5.925781 0.1875 13 C 0.1875 20.074219 5.925781 25.8125 13 25.8125 C 20.074219 25.8125 25.8125 20.074219 25.8125 13 C 25.8125 5.925781 20.074219 0.1875 13 0.1875 Z M 19.734375 9.035156 L 12.863281 19.167969 C 12.660156 19.46875 12.335938 19.671875 12.015625 19.671875 C 11.695313 19.671875 11.34375 19.496094 11.117188 19.273438 L 7.085938 15.238281 C 6.8125 14.964844 6.8125 14.515625 7.085938 14.242188 L 8.082031 13.246094 C 8.355469 12.972656 8.804688 12.972656 9.074219 13.246094 L 11.699219 15.867188 L 17.402344 7.453125 C 17.621094 7.132813 18.0625 7.050781 18.382813 7.265625 L 19.550781 8.058594 C 19.867188 8.273438 19.953125 8.714844 19.734375 9.035156 Z"></path>
                                </svg>
                              </BUTTon>
                             @endif
                       
                            @if ($salida->estado == "Generada")
                            <p style="color:#FF0000";>Generada</p>
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
@endsection