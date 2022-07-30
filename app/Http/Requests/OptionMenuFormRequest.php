<?php

namespace App\Http\Requests;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class OptionMenuFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'codOption' => 'max:10|unique:OptionMenu,codOption,'.$this->idOption.',idOption',
            'description' => 'max:100',
            'flag_estatus' => 'boolean'
        ];
    }
    public function messages()
    {
        return [
       
          'codOption.unique' => 'Este valor ya fue registrado.',
          'codOption.max' => 'El valor ingresado no debe ser mayor a 10 caracteres.',
          'description.max' => 'El valor ingresado no debe ser mayor a 100 caracteres.',
          'flag_estatus.boolean' => 'ingrese un valor booleano'
        ];
    }
    protected function failedValidation(Validator $validator) 
    { throw new HttpResponseException(response()->json($validator->errors(), 422)); }
}
