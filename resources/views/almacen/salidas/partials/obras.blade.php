
<div class="my-div">
    <x-adminlte-select-bs class="js-example-tags" name="obraSelect1" for="obraSelect1"  id="obraSelect1"  label="Seleccione Obra"  onchange="cargarInsumos(this.value)"> label-class="text-lightblue"
        igroup-size="lg" data-title="Seleccione Obra" data-live-search
        data-live-search-placeholder="Search..." data-show-tick>
        <x-slot name="prependSlot">
            <div class="input-group-text bg-gradient-info">
                <i class="fas fa-car-side"></i>
            </div>
        </x-slot>
        <option value="" class="input input-bordered input-info w-full max-w-xs">Seleccione Obras</option>
        @foreach ($obras as $obra)
            <option value="{{ $obra->Codigo_Obra }}" class="input input-bordered input-info w-full max-w-xs">{{ $obra->Nombre_Obra }}</option>
        @endforeach
    </x-adminlte-select-bs>

</div>


