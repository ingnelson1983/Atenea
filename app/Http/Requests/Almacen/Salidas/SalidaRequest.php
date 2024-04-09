<?php

namespace App\Http\Requests\Almacen\Salidas;

use Illuminate\Foundation\Http\FormRequest;

class SalidaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
            //Aca en esta sección se ingresan las validaciones que se deben hacer
            return [
                'id_usu'=>'required|numeric',
                'proyecto_id'=>'required|numeric',
                'fecha_Salida'=>'required',
                 'nom_material'=>'required',
                'unidad_medida'=>'required',
                'cantidad'=>'required|numeric',
                'destino'=>'required',
                'descripcion'=>'required',
                'estado'=>'required',



                    ];
    }

    //Se crea una nueva función, en donde se van establecer los mensjaes que se van a generar de acuerdo a la validacion anteruir

    public function messages():array
    {
        return [
            'required'=>'El campo e s obligatorio',
            'id_usu.numeric'=>'El campo debe ser un numero',
            'proyecto_id.numeric'=>'El campo debe ser un numero',
            'cantidad.numeric'=>'El campo debe ser un numero'
        ];

    }
}
