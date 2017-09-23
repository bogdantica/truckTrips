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

        return [];

        return [
            'sender_company_id' => 'required|present|string|max:255',
            'receiver_company_id' => 'required|present|string|max:255',
            'truck_id' => 'required|string|max:255',
            'driver_user_id' => 'required|string|max:255',
            'load_weight' => 'required_without:load_volume|numeric|nullable',
            'load_volume' => 'required_without:load_weight|nullable|numeric',
            'pay_distance' => 'required|numeric',
            'real_distance' => 'nullable|numeric',

            'start_point.place_id' => 'required|present|string|max:255',
            'start_point.current_kilometers' => 'required|numeric',
            'start_point.departed_at' => 'required|date_format:d/m/Y H:i',

            'end_point.place_id' => 'required|present|string|max:255',
            'end_point.current_kilometers' => 'nullable|numeric',
            'end_point.departed_at' => 'nullable|date_format:d/m/Y H:i',


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

            'start_point.place_id.required' => 'Alege Locul de Plecare',
            'start_point.current_kilometers.required' => 'Kilometri la plecare sunt necesari',
            'start_point.departed_at.required' => 'Data plecarii este necesara',
            'start_point.departed_at.date_format' => 'Data trebuie sa fie de forma: zi/luna/an ora:minut, Ex: 24/09/2015 10:12',


            'end_point.place_id.required' => 'Alege Locul de Sosire',
            'end_point.departed_at' => 'Data trebuie sa fie de forma: zi/luna/an ora:minut, Ex: 24/09/2015 10:12',
        ];
    }

}
