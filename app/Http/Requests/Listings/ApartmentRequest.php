<?php

namespace App\Http\Requests\Listings;

use Illuminate\Foundation\Http\FormRequest;

class ApartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'details.elevator'          => ['required', 'boolean'],
            'details.year_build_id'     => ['required', 'exists:year_builds,id'],
            'details.condition_id'      => ['required', 'exists:conditions,id'],
            'details.furnishing_id'     => ['required', 'exists:furnishings,id'],
            'details.orientation_id'    => ['required', 'exists:orientations,id'],
            'details.heating_id'        => ['required', 'exists:heatings,id'],
            'details.bedrooms'          => ['required', 'integer', 'min:0'],
            'details.bathrooms'         => ['required', 'integer', 'min:0'],
            'details.floor'             => ['required', 'integer', 'min:0'],
            'details.balcony'           => ['required', 'boolean'],
            'details.veranda'           => ['required', 'boolean'],
            'details.garden'            => ['required', 'boolean'],
            'details.apartment_type_id' => ['required', 'exists:apartment_types,id'],
        ];
    }

    public function attributes(): array
    {
        return [
            'details.elevator'          => 'Ashensori',
            'details.year_build_id'     => 'Viti i ndërtimit',
            'details.condition_id'      => 'Gjendja',
            'details.furnishing_id'     => 'Mobilimi',
            'details.orientation_id'    => 'Orientimi',
            'details.heating_id'        => 'Ngrohja',
            'details.bedrooms'          => 'Dhomat e gjumit',
            'details.bathrooms'         => 'Banjo',
            'details.floor'             => 'Kati',
            'details.balcony'           => 'Ballkoni',
            'details.veranda'           => 'Veranda',
            'details.garden'            => 'Kopshti',
            'details.apartment_type_id' => 'Tipi i apartamentit',
        ];
    }

    public function messages(): array
    {
        return [
            // Required
            'details.elevator.required'       => 'Ju lutem specifikoni nëse apartamenti ka ashensor.',
            'details.year_build_id.required'  => 'Ju lutem zgjidhni vitin e ndërtimit.',
            'details.condition_id.required'   => 'Ju lutem zgjidhni gjendjen.',
            'details.furnishing_id.required'  => 'Ju lutem zgjidhni mobilimin.',
            'details.orientation_id.required' => 'Ju lutem zgjidhni orientimin.',
            'details.heating_id.required'     => 'Ju lutem zgjidhni ngrohjen.',
            'details.bedrooms.required'       => 'Ju lutem vendosni numrin e dhomave të gjumit.',
            'details.bathrooms.required'      => 'Ju lutem vendosni numrin e banjove.',
            'details.floor.required'          => 'Ju lutem vendosni katin.',
            'details.balcony.required'        => 'Ju lutem specifikoni nëse apartamenti ka ballkon.',
            'details.veranda.required'        => 'Ju lutem specifikoni nëse apartamenti ka verandë.',
            'details.garden.required'         => 'Ju lutem specifikoni nëse apartamenti ka kopsht.',
            'details.apartment_type_id.required' => 'Ju lutem zgjidhni tipin e apartamentit.',

            // Types
            'details.elevator.boolean'    => 'Ashensori duhet të jetë po ose jo.',
            'details.bedrooms.integer'    => 'Numri i dhomave të gjumit duhet të jetë numër i plotë.',
            'details.bathrooms.integer'   => 'Numri i banjove duhet të jetë numër i plotë.',
            'details.floor.integer'       => 'Kati duhet të jetë numër i plotë.',
            'details.balcony.boolean'     => 'Ballkoni duhet të jetë po ose jo.',
            'details.veranda.boolean'     => 'Veranda duhet të jetë po ose jo.',
            'details.garden.boolean'      => 'Kopshti duhet të jetë po ose jo.',

            // Min / Max (if rules exist)
            'details.bedrooms.min'        => 'Numri i dhomave të gjumit nuk mund të jetë më pak se :min.',
            'details.bathrooms.min'       => 'Numri i banjove nuk mund të jetë më pak se :min.',
            'details.floor.min'           => 'Kati nuk mund të jetë më pak se :min.',
            'details.bedrooms.max'        => 'Numri i dhomave të gjumit nuk mund të jetë më shumë se :max.',
            'details.bathrooms.max'       => 'Numri i banjove nuk mund të jetë më shumë se :max.',
            'details.floor.max'           => 'Kati nuk mund të jetë më shumë se :max.',

            // Exists
            'details.year_build_id.exists'     => 'Viti i ndërtimit i zgjedhur nuk është i vlefshëm.',
            'details.condition_id.exists'      => 'Gjendja e zgjedhur nuk është e vlefshme.',
            'details.furnishing_id.exists'     => 'Mobilimi i zgjedhur nuk është i vlefshëm.',
            'details.orientation_id.exists'    => 'Orientimi i zgjedhur nuk është i vlefshëm.',
            'details.heating_id.exists'        => 'Ngrohja e zgjedhur nuk është e vlefshme.',
            'details.apartment_type_id.exists' => 'Tipi i apartamentit i zgjedhur nuk është i vlefshëm.',
        ];
    }
}
