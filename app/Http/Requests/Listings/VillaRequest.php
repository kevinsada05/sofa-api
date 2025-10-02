<?php

namespace App\Http\Requests\Listings;

use Illuminate\Foundation\Http\FormRequest;

class VillaRequest extends FormRequest
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
            'details.bedrooms'       => ['required', 'integer', 'min:0'],
            'details.bathrooms'      => ['required', 'integer', 'min:0'],
            'details.floors'         => ['required', 'integer', 'min:0'],
            'details.balcony'        => ['required', 'boolean'],
            'details.veranda'        => ['required', 'boolean'],
            'details.garden'         => ['required', 'boolean'],
            'details.parking'        => ['required', 'boolean'],
            'details.pool'           => ['required', 'boolean'],
            'details.basement'       => ['required', 'boolean'],
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
            'details.bedrooms'       => 'Dhomat e gjumit',
            'details.bathrooms'      => 'Banjo',
            'details.floors'         => 'Katet',
            'details.balcony'        => 'Ballkoni',
            'details.veranda'        => 'Veranda',
            'details.garden'         => 'Kopshti',
            'details.parking'        => 'Parkimi',
            'details.pool'           => 'Pishina',
            'details.basement'       => 'Bodrumi',
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
            'details.bedrooms.required'       => 'Ju lutem vendosni numrin e dhomave të gjumit.',
            'details.bathrooms.required'      => 'Ju lutem vendosni numrin e banjove.',
            'details.floors.required'         => 'Ju lutem vendosni numrin e kateve.',
            'details.balcony.required'        => 'Ju lutem specifikoni nëse vila ka ballkon.',
            'details.veranda.required'        => 'Ju lutem specifikoni nëse vila ka verandë.',
            'details.garden.required'         => 'Ju lutem specifikoni nëse vila ka kopsht.',
            'details.parking.required'        => 'Ju lutem specifikoni nëse vila ka parkim.',
            'details.pool.required'           => 'Ju lutem specifikoni nëse vila ka pishinë.',
            'details.basement.required'       => 'Ju lutem specifikoni nëse vila ka bodrum.',

            // Types
            'details.bedrooms.integer'        => 'Numri i dhomave të gjumit duhet të jetë numër i plotë.',
            'details.bathrooms.integer'       => 'Numri i banjove duhet të jetë numër i plotë.',
            'details.floors.integer'          => 'Numri i kateve duhet të jetë numër i plotë.',
            'details.balcony.boolean'         => 'Ballkoni duhet të jetë po ose jo.',
            'details.veranda.boolean'         => 'Veranda duhet të jetë po ose jo.',
            'details.garden.boolean'          => 'Kopshti duhet të jetë po ose jo.',
            'details.parking.boolean'         => 'Parkimi duhet të jetë po ose jo.',
            'details.pool.boolean'            => 'Pishina duhet të jetë po ose jo.',
            'details.basement.boolean'        => 'Bodrumi duhet të jetë po ose jo.',

            // Min
            'details.bedrooms.min'            => 'Numri i dhomave të gjumit nuk mund të jetë më pak se :min.',
            'details.bathrooms.min'           => 'Numri i banjove nuk mund të jetë më pak se :min.',
            'details.floors.min'              => 'Numri i kateve nuk mund të jetë më pak se :min.',

            // Exists
            'details.year_build_id.exists'    => 'Viti i ndërtimit i zgjedhur nuk është i vlefshëm.',
            'details.condition_id.exists'     => 'Gjendja e zgjedhur nuk është e vlefshme.',
            'details.furnishing_id.exists'    => 'Mobilimi i zgjedhur nuk është i vlefshëm.',
            'details.orientation_id.exists'   => 'Orientimi i zgjedhur nuk është i vlefshëm.',
            'details.heating_id.exists'       => 'Ngrohja e zgjedhur nuk është e vlefshme.',
        ];
    }
}
