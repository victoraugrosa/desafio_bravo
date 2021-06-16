<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CurrencyGetRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'id'    => 'integer'    
        ];
    }

    public function messages()
    {
        return [
            'id.integer'    => 'integer valdi'    
        ];
    }

    // public $validator = null;
    // protected function failedValidation($validator)
    // {
    //     $this->validator = $validator;
    // }
    // protected function failedValidation($validator) { 
    //     $response = [
    //         'status' => false,
    //         'message' => $validator->errors()->first(),
    //         'data' => $validator->errors()
    //     ];
    //     throw new HttpResponseException(response()->json($response, 200)); 
    // }

    // public function withValidator($validator)
    // {
    //     $validator->after(function ($validator) {
    //         if ($this->somethingElseIsInvalid()) {
    //             $validator->errors()->add('email', 'Please enter valid email id');
    //         }
    //     });
    // }
//     public function withValidator($validator)
// {
//     if(!$validator->fails()){
//         $validator->after(function ($validator){
//             if(!$this->checkAvailable($this->input(['id']))){
//                 $validator->errors()->add('unavailable', 'The dates you selected are busy!');
//             }
//         });
//     }
// }

}
