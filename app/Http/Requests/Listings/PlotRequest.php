<?php

namespace App\Http\Requests\Listings;

use Illuminate\Foundation\Http\FormRequest;

class PlotRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'details.building_coefficient' => ['required', 'numeric', 'min:0', 'max:999.99'],
            'details.construction_permit'  => ['required', 'boolean'],
            'details.water'                => ['required', 'boolean'],
            'details.electricity'          => ['required', 'boolean'],
            'details.sewerage'             => ['required', 'boolean'],
            'details.road_access'          => ['required', 'boolean'],
            'details.terrain_type_id'      => ['required', 'exists:terrain_types,id'],
        ];
    }

    public function attributes(): array
    {
        return [
            'details.building_coefficient' => 'Koeficient ndërtimi',
            'details.construction_permit'  => 'Leje ndërtimi',
            'details.water'                => 'Ujë',
            'details.electricity'          => 'Energji elektrike',
            'details.sewerage'             => 'Kanalizime',
            'details.road_access'          => 'Akses në rrugë',
            'details.terrain_type_id'      => 'Tipi i terrenit',
        ];
    }

    public function messages(): array
    {
        return [
            // Required
            'details.building_coefficient.required' => 'Ju lutem vendosni koeficientin e ndërtimit.',
            'details.construction_permit.required'  => 'Ju lutem specifikoni nëse ka leje ndërtimi.',
            'details.water.required'                => 'Ju lutem specifikoni nëse ka ujë.',
            'details.electricity.required'          => 'Ju lutem specifikoni nëse ka energji elektrike.',
            'details.sewerage.required'             => 'Ju lutem specifikoni nëse ka kanalizime.',
            'details.road_access.required'          => 'Ju lutem specifikoni nëse ka akses në rrugë.',
            'details.terrain_type_id.required'      => 'Ju lutem zgjidhni tipin e terrenit.',

            // Type / limits
            'details.building_coefficient.numeric'  => 'Koeficienti i ndërtimit duhet të jetë numër.',
            'details.building_coefficient.min'      => 'Koeficienti i ndërtimit nuk mund të jetë negativ.',
            'details.building_coefficient.max'      => 'Koeficienti i ndërtimit nuk mund të jetë më i madh se 999.99.',
            'details.construction_permit.boolean'   => 'Leja e ndërtimit duhet të jetë po ose jo.',
            'details.water.boolean'                 => 'Uji duhet të jetë po ose jo.',
            'details.electricity.boolean'           => 'Energjia elektrike duhet të jetë po ose jo.',
            'details.sewerage.boolean'              => 'Kanalizimet duhet të jenë po ose jo.',
            'details.road_access.boolean'           => 'Aksesi në rrugë duhet të jetë po ose jo.',

            // Exists
            'details.terrain_type_id.exists'        => 'Tipi i terrenit i zgjedhur nuk është i vlefshëm.',

        ];
    }
}
