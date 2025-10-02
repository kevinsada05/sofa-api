<?php

namespace App\Http\Requests\Listings;

use Illuminate\Foundation\Http\FormRequest;

class GarsoniereRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'details.year_build_id'  => ['required', 'exists:year_builds,id'],
            'details.condition_id'   => ['required', 'exists:conditions,id'],
            'details.furnishing_id'  => ['required', 'exists:furnishings,id'],
            'details.orientation_id' => ['required', 'exists:orientations,id'],
            'details.heating_id'     => ['required', 'exists:heatings,id'],
            'details.bathrooms'      => ['required', 'integer', 'min:0'],
            'details.floor'          => ['required', 'integer', 'min:0'],
            'details.balcony'        => ['required', 'boolean'],
            'details.veranda'        => ['required', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'details.year_build_id'  => 'Viti i ndërtimit',
            'details.condition_id'   => 'Gjendja',
            'details.furnishing_id'  => 'Mobilimi',
            'details.orientation_id' => 'Orientimi',
            'details.heating_id'     => 'Ngrohja',
            'details.bathrooms'      => 'Banjo',
            'details.floor'          => 'Kati',
            'details.balcony'        => 'Ballkoni',
            'details.veranda'        => 'Veranda',
        ];
    }

    public function messages(): array
    {
        return [
            // Required
            'details.year_build_id.required'  => 'Ju lutem zgjidhni vitin e ndërtimit.',
            'details.condition_id.required'   => 'Ju lutem zgjidhni gjendjen.',
            'details.furnishing_id.required'  => 'Ju lutem zgjidhni mobilimin.',
            'details.orientation_id.required' => 'Ju lutem zgjidhni orientimin.',
            'details.heating_id.required'     => 'Ju lutem zgjidhni ngrohjen.',
            'details.bathrooms.required'      => 'Ju lutem vendosni numrin e banjove.',
            'details.floor.required'          => 'Ju lutem vendosni katin.',
            'details.balcony.required'        => 'Ju lutem specifikoni nëse ka ballkon.',
            'details.veranda.required'        => 'Ju lutem specifikoni nëse ka verandë.',

            // Type validations
            'details.bathrooms.integer'  => 'Numri i banjove duhet të jetë numër i plotë.',
            'details.floor.integer'      => 'Kati duhet të jetë numër i plotë.',
            'details.balcony.boolean'    => 'Ballkoni duhet të jetë po ose jo.',
            'details.veranda.boolean'    => 'Veranda duhet të jetë po ose jo.',

            // Exists
            'details.year_build_id.exists'  => 'Viti i ndërtimit i zgjedhur nuk është i vlefshëm.',
            'details.condition_id.exists'   => 'Gjendja e zgjedhur nuk është e vlefshme.',
            'details.furnishing_id.exists'  => 'Mobilimi i zgjedhur nuk është i vlefshëm.',
            'details.orientation_id.exists' => 'Orientimi i zgjedhur nuk është i vlefshëm.',
            'details.heating_id.exists'     => 'Ngrohja e zgjedhur nuk është e vlefshme.',
            'details.bathrooms.min' => 'Numri i banjove nuk mund të jetë më pak se :min.',
            'details.floor.min'     => 'Kati nuk mund të jetë më pak se :min.',
        ];
    }
}
