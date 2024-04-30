
<div class="my-div">
    <x-adminlte-select-bs class="js-example-tags" name="insumoSelect" for="insumoSelect"  id="insumoSelect"  label="Seleccione Insumo"  onchange="cargarItems(this.value)"> label-class="text-lightblue"
        igroup-size="lg" data-title="Seleccione Insumo" data-live-search
        data-live-search-placeholder="Search..." data-show-tick>
        <x-slot name="prependSlot">
            <div class="input-group-text bg-gradient-info">
                <i class="fas fa-car-side"></i>
            </div>
        </x-slot>
        <option value="" class="input input-bordered input-info w-full max-w-xs">Seleccione Insumo</option>
        @foreach ($insumos as $insumo)
            <option value="{{ $insumo->Cod_Insumo }}" class="input input-bordered input-info w-full max-w-xs">{{ $insumo->Nombre_Insumo }}</option>
        @endforeach
    </x-adminlte-select-bs>

</div>
