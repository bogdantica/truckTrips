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
            'agreement_date' => 'required|date_format:d/m/Y',
            'beneficiary_company_id' => 'required|exists:companies,id',
            'vehicles' => 'required|array',
            'vehicles.*' => 'required|exists:vehicles,id',
            'driver_user_id' => 'required|exists:users,id',

            'startPoint.address.street' => 'nullable|string',
            'startPoint.address.number' => 'nullable|string',
            'startPoint.address.county' => 'nullable|string',
            'startPoint.address.locality' => 'required|string',
            'startPoint.address.country' => 'required|string',
            'startPoint.schedule_date' => 'required|date_format:d/m/Y',
            'startPoint.schedule_time' => 'nullable|date_format:H:i',
            'startPoint.cargo_weight' => 'nullable|numeric',
            'startPoint.cargo_volume' => 'nullable|numeric',
            'startPoint.details' => 'nullable|string',

            'endPoint.address.street' => 'nullable|string',
            'endPoint.address.number' => 'nullable|string',
            'endPoint.address.county' => 'nullable|string',
            'endPoint.address.locality' => 'required|string',
            'endPoint.address.country' => 'required|string',
            'endPoint.schedule_date' => 'required|date_format:d/m/Y',
            'endPoint.schedule_time' => 'nullable|date_format:H:i',
            'endPoint.cargo_weight' => 'nullable|numeric',
            'endPoint.cargo_volume' => 'nullable|numeric',
            'endPoint.details' => 'nullable|string',

            'point.new.*.address.street' => 'nullable|string',
            'point.new.*.address.number' => 'nullable|string',
            'point.new.*.address.county' => 'nullable|string',
            'point.new.*.address.locality' => 'required|string',
            'point.new.*.address.country' => 'required|string',
            'point.new.*.schedule_date' => 'required|date_format:d/m/Y',
            'point.new.*.schedule_time' => 'nullable|date_format:H:i',
            'point.new.*.cargo_weight' => 'nullable|numeric',
            'point.new.*.cargo_volume' => 'nullable|numeric',
            'point.new.*.details' => 'nullable|string',

            'services.new.*name' => 'required|string',
            'services.new.*quantity' => 'required|numeric',
            'services.new.*price' => 'required|numeric',
            'services.new.*total' => 'required|numeric',

            'agreement' => 'nullable|string'

        ];

//        return [
//            'sender_company_id' => 'required|present|string|max:255',
//            'receiver_company_id' => 'required|present|string|max:255',
//            'truck_id' => 'required|string|max:255',
//            'driver_user_id' => 'required|string|max:255',
//            'load_weight' => 'required_without:load_volume|numeric|nullable',
//            'load_volume' => 'required_without:load_weight|nullable|numeric',
//            'pay_distance' => 'required|numeric',
//            'real_distance' => 'nullable|numeric',
//
//            'start_point.place_id' => 'required|present|string|max:255',
//            'start_point.current_kilometers' => 'required|numeric',
//            'start_point.departed_at' => 'required|date_format:d/m/Y H:i',
//
//            'end_point.place_id' => 'required|present|string|max:255',
//            'end_point.current_kilometers' => 'nullable|numeric',
//            'end_point.departed_at' => 'nullable|date_format:d/m/Y H:i',
//
//
//        ];
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
