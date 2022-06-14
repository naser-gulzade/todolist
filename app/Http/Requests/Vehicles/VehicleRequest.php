<?php

namespace App\Http\Requests\Vehicles;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class VehicleRequest extends FormRequest
{
   //override failed validation with json response
   protected function failedValidation(Validator $validator)
   {
       throw new HttpResponseException(response()->json($validator->errors(), 422));
   }
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
    * @return array
   */
   public function rules()
   {
       switch($this->method())
       {
           case 'POST':
           {
               return [
                   'category_id'            => 'required|integer',
                   'color'                  => 'required|string|Max:250',
                   'model'                  => 'required|string|Max:250',
                   'make'                   => 'required|string|Max:250',
                   'registration_no'        => 'required|string|Max:250',
               ];
           }
           case 'PATCH':
           {
               return [
                'category_id'            => 'sometimes|required|integer',
                'color'                  => 'sometimes|required|string|Max:250',
                'model'                  => 'sometimes|required|string|Max:250',
                'make'                   => 'sometimes|required|string|Max:250',
                'registration_no'        => 'sometimes|required|string|Max:250',
               ];                    
           }
           case 'PUT':
           {
               return [
                   'category_id'            => 'required|integer',
                   'color'                  => 'required|string|Max:250',
                   'model'                  => 'required|string|Max:250',
                   'make'                   => 'required|string|Max:250',
                   'registration_no'        => 'required|string|Max:250',
               ];                    
           }
           default: break;
       }
   }
}
