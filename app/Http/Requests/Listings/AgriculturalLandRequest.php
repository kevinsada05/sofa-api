<?php

namespace App\Http\Requests\Listings;

use Illuminate\Foundation\Http\FormRequest;

class AgriculturalLandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'details.water_access'       => ['required', 'boolean'],
            'details.electricity_access' => ['required', 'boolean'],
            'details.road_access'        => ['required', 'boolean'],
            'details.land_type_id'       => ['required', 'exists:land_types,id'],
            'details.irrigation_system'  => ['required', 'boolean'],
            'details.soil_quality_id'    => ['required', 'exists:soil_qualities,id'],
            'details.fenced'             => ['required', 'boolean'],
            'details.terrain_type_id'    => ['required', 'exists:terrain_types,id'],
        ];
    }

    public function attributes(): array
    {
        return [
            'details.water_access'       => 'Instalime Hidraulike',
            'details.electricity_access' => 'Akses në energji elektrike',
            'details.road_access'        => 'Akses në rrugë',
            'details.land_type_id'       => 'Tipi i tokës',
            'details.irrigation_system'  => 'Sistemi i ujitjes',
            'details.soil_quality_id'    => 'Cilësia e tokës',
            'details.fenced'             => 'I rrethuar',
            'details.terrain_type_id'    => 'Tipi i terrenit',
        ];
    }

    public function messages(): array
    {
        return [
            // Required
            'details.water_access.required'       => 'Ju lutem specifikoni nëse ka Instalime Hidraulike.',
            'details.electricity_access.required' => 'Ju lutem specifikoni nëse ka akses në energji elektrike.',
            'details.road_access.required'        => 'Ju lutem specifikoni nëse ka akses në rrugë.',
            'details.land_type_id.required'       => 'Ju lutem zgjidhni tipin e tokës.',
            'details.irrigation_system.required'  => 'Ju lutem specifikoni nëse ka sistem ujitjeje.',
            'details.soil_quality_id.required'    => 'Ju lutem zgjidhni cilësinë e tokës.',
            'details.fenced.required'             => 'Ju lutem specifikoni nëse toka është e rrethuar.',
            'details.terrain_type_id.required'    => 'Ju lutem zgjidhni tipin e terrenit.',

            // Boolean
            'details.water_access.boolean'        => 'Instalime Hidraulike duhet të jetë po ose jo.',
            'details.electricity_access.boolean'  => 'Aksesi në energji elektrike duhet të jetë po ose jo.',
            'details.road_access.boolean'         => 'Aksesi në rrugë duhet të jetë po ose jo.',
            'details.irrigation_system.boolean'   => 'Sistemi i ujitjes duhet të jetë po ose jo.',
            'details.fenced.boolean'              => 'Rrethimi duhet të jetë po ose jo.',

            // Exists
            'details.land_type_id.exists'         => 'Tipi i tokës i zgjedhur nuk është i vlefshëm.',
            'details.soil_quality_id.exists'      => 'Cilësia e tokës e zgjedhur nuk është e vlefshme.',
            'details.terrain_type_id.exists'      => 'Tipi i terrenit i zgjedhur nuk është i vlefshëm.',
        ];
    }
}
