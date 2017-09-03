<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripRequest extends FormRequest
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
            'sender_company_id' => 'required|present|string|max:255',
            'receiver_company_id' => 'required|present|string|max:255',
            'truck_id' => 'required|string|max:255',
            'driver_user_id' => 'required|string|max:255',
            'load_weight' => 'required_without:load_volume|numeric|nullable',
            'load_volume' => 'required_without:load_weight|nullable|numeric',
            'pay_distance' => 'required|numeric',
            'real_distance' => 'nullable|numeric',
            'basic_points.10.place_id' => 'required|present|string:max255',
            'basic_points.30.place_id' => 'required|present|string:max255',
        ];
    }

    public function messages()
    {
        return [
            'sender_company_id.required' => 'Alege un Expeditor',
            'receiver_company_id.required' => 'Alege un Destinatar',
            'truck_id.required' => 'Alege un Camion',
            'driver_user_id.required' => 'Alege un Sofer',
            'load_weight.required_without' => 'Scrie Masa Neta sau Volumul',
            'load_weight.numeric' => 'Masa Neta trebuie sa fie de forma Numerica',
            'load_volume.required_without' => 'Scrie Volumnul sau Masa Neta',
            'pay_distance.required' => 'Scrie Distanta oferta de expeditor',
            'real_distance.numeric' => 'Distanta trebuie sa fie de forma Numerica',
            'basic_points.10.place_id.required' => 'Alege Locul de Plecare',
            'basic_points.30.place_id.required' => 'Alege Locul de Sosire',

        ];
    }

}
