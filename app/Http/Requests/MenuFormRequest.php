<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class MenuFormRequest extends FormRequest
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
            'codMenu' => 'max:10|unique:Menu,codMenu,'.$this->idMenu.',idMenu',
            'description' => 'max:100',
            'flag_estatus' => 'boolean'
           
        ];
    }
    public function messages()
    {
        return [
       
          'codMenu.unique' => 'Este valor ya fue registrado.',
          'codMenu.max' => 'El valor ingresado no debe ser mayor a 10 caracteres.',
          'description.max' => 'El valor ingresado no debe ser mayor a 100 caracteres.',
          'flag_estatus.boolean' => 'ingrese un valor booleano'
        ];
    }
    protected function failedValidation(Validator $validator) 
    { throw new HttpResponseException(response()->json($validator->errors(), 422)); }
}
