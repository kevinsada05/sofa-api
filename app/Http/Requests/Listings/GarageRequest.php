<?php

namespace App\Http\Requests\Listings;

use Illuminate\Foundation\Http\FormRequest;

class GarageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'details.capacity'         => ['required', 'integer', 'min:1'], // must fit at least 1 car
            'details.electric_door'    => ['required', 'boolean'],
            'details.security_camera'  => ['required', 'boolean'],
            'details.lighting'         => ['required', 'boolean'],
            'details.electricity'      => ['required', 'boolean'],
            'details.indoor'           => ['required', 'boolean'],
            'details.floor'            => ['required', 'integer', 'min:-5'], // allow basement levels
        ];
    }

    public function attributes(): array
    {
        return [
            'details.capacity'        => 'Kapaciteti (numri i makinave)',
            'details.electric_door'   => 'Dera elektrike',
            'details.security_camera' => 'Kamera sigurie',
            'details.lighting'        => 'Ndriçimi',
            'details.electricity'     => 'Energjia elektrike',
            'details.indoor'          => 'Brenda ndërtesës',
            'details.floor'           => 'Kati',
        ];
    }

    public function messages(): array
    {
        return [
            // Required
            'details.capacity.required'        => 'Ju lutem vendosni kapacitetin e garazhit.',
            'details.electric_door.required'   => 'Ju lutem specifikoni nëse ka derë elektrike.',
            'details.security_camera.required' => 'Ju lutem specifikoni nëse ka kamera sigurie.',
            'details.lighting.required'        => 'Ju lutem specifikoni nëse ka ndriçim.',
            'details.electricity.required'     => 'Ju lutem specifikoni nëse ka energji elektrike.',
            'details.indoor.required'          => 'Ju lutem specifikoni nëse është brenda ndërtesës.',
            'details.floor.required'           => 'Ju lutem vendosni katin.',
            'details.capacity.integer'         => 'Kapaciteti duhet të jetë numër i plotë.',
            'details.capacity.min'             => 'Kapaciteti duhet të jetë të paktën 1 makinë.',
            'details.electric_door.boolean'    => 'Dera elektrike duhet të jetë po ose jo.',
            'details.security_camera.boolean'  => 'Kamera sigurie duhet të jetë po ose jo.',
            'details.lighting.boolean'         => 'Ndriçimi duhet të jetë po ose jo.',
            'details.electricity.boolean'      => 'Energjia elektrike duhet të jetë po ose jo.',
            'details.indoor.boolean'           => 'Brenda ndërtesës duhet të jetë po ose jo.',
            'details.floor.integer'            => 'Kati duhet të jetë numër i plotë.',
            'details.floor.min' => 'Kati nuk mund të jetë më pak se :min.',
        ];
    }
}
