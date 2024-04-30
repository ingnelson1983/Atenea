
@extends('adminlte::page')

@section('title','content_header')

@section('content_header')
    <h1 class="m-0 text-dark">CONSULTAR INSUMOS</h1>
@stop

@section('content')


<x-adminlte-select-bs class="js-example-tags" name="empresaSelect" for="empresaSelect"  id="empresaSelect"  label="Seleccione Empresa"  onchange="cargarObras()"> label-class="text-lightblue"
    igroup-size="lg" data-title="Seleccione Empresa" data-live-search
    data-live-search-placeholder="Search..." data-show-tick>
    <x-slot name="prependSlot">
        <div class="input-group-text bg-gradient-info">
            <i class="fas fa-car-side"></i>
        </div>
    </x-slot>
    <option value="" class="input input-bordered input-info w-full max-w-xs">Seleccione Empresa</option>
    @foreach ($empresas as $empresa)
        <option value="{{ $empresa->Cod_Empresa }}" class="input input-bordered input-info w-full max-w-xs">{{ $empresa->Nom_Empresa }}</option>
    @endforeach
</x-adminlte-select-bs>



    <p>Selección de Obras</p>
    <div id="obraSelect" > Seleccione una empresa primero   </div>

    <p>Selección de Insumos</p>
    <div id="insumoSelect">Seleccione una obra primero</div>

    <p>Información de Items</p>
    <div id="itemSelect">Seleccione un insumo primero</div>

    <script>
        function cargarObras() {
            var empresaId = document.getElementById('empresaSelect').value;
            if (empresaId) {
                fetch(`/almacen/ConsultarInsumos/obras/${empresaId}`)  // Asegura el uso de comillas correctas
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('obraSelect').innerHTML = html;
                        $('#obraSelect select').select2();
                        document.getElementById('insumoSelect').innerHTML = 'Seleccione una obra primero';
                        document.getElementById('itemSelect').innerHTML = 'Seleccione un insumo primero';
                    });
            } else {
                document.getElementById('obraSelect').innerHTML = 'Seleccione una empresa primero';
                document.getElementById('insumoSelect').innerHTML = 'Seleccione una obra primero';
                document.getElementById('itemSelect').innerHTML = 'Seleccione un insumo primero';
            }
        }
    
        function cargarInsumos(obraId) {
            if (obraId) {
                fetch(`/almacen/ConsultarInsumos/insumos/${obraId}`)  // Asegura el uso de comillas correctas
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('insumoSelect').innerHTML = html;
                        $('#insumoSelect select').select2();
                        document.getElementById('itemSelect').innerHTML = 'Seleccione un insumo primero';
                    });
            } else {
                document.getElementById('insumoSelect').innerHTML = 'Seleccione una obra primero';
                document.getElementById('itemSelect').innerHTML = 'Seleccione un insumo primero';
            }
        }
    
        function cargarItems(insumoId) {
            if (insumoId) {
                fetch(`/almacen/ConsultarInsumos/items/${insumoId}`)  // Asegura el uso de comillas correctas
                    .then(response => response.text())
                    .then(html => document.getElementById('itemSelect').innerHTML = html);
            } else {
                document.getElementById('itemSelect').innerHTML = 'Seleccione un insumo primero';
            }
        }
    </script>
@endsection


@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection


@section('js')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(".js-example-tags").select2({
    tags: true
  });
  </script>
@endsection