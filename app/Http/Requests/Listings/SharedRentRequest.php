<?php

namespace App\Http\Requests\Listings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SharedRentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
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
            'details.room_available'    => ['required', 'boolean'],
            'details.total_roommates'   => ['required', 'integer', 'min:1'],
            'details.gender_preference' => ['required', Rule::in(['male', 'female', 'any'])],
            'details.student_only'      => ['required', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
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
            'details.room_available'    => 'Dhomë e lirë',
            'details.total_roommates'   => 'Numri i bashkëjetuesve',
            'details.gender_preference' => 'Preferenca e gjinisë',
            'details.student_only'      => 'Vetëm studentë',
        ];
    }

    public function messages(): array
    {
        return [
            // Required
            'details.year_build_id.required'     => 'Ju lutem zgjidhni vitin e ndërtimit.',
            'details.condition_id.required'      => 'Ju lutem zgjidhni gjendjen.',
            'details.furnishing_id.required'     => 'Ju lutem zgjidhni mobilimin.',
            'details.orientation_id.required'    => 'Ju lutem zgjidhni orientimin.',
            'details.heating_id.required'        => 'Ju lutem zgjidhni ngrohjen.',
            'details.bedrooms.required'          => 'Ju lutem vendosni numrin e dhomave të gjumit.',
            'details.bathrooms.required'         => 'Ju lutem vendosni numrin e banjove.',
            'details.floor.required'             => 'Ju lutem vendosni katin.',
            'details.balcony.required'           => 'Ju lutem specifikoni nëse ka ballkon.',
            'details.veranda.required'           => 'Ju lutem specifikoni nëse ka verandë.',
            'details.garden.required'            => 'Ju lutem specifikoni nëse ka kopsht.',
            'details.apartment_type_id.required' => 'Ju lutem zgjidhni tipin e apartamentit.',
            'details.room_available.required'    => 'Ju lutem specifikoni nëse dhoma është e lirë.',
            'details.total_roommates.required'   => 'Ju lutem vendosni numrin e bashkëjetuesve.',
            'details.gender_preference.required' => 'Ju lutem zgjidhni preferencën e gjinisë.',
            'details.student_only.required'      => 'Ju lutem specifikoni nëse është vetëm për studentë.',

            // Types
            'details.bedrooms.integer'         => 'Numri i dhomave të gjumit duhet të jetë numër i plotë.',
            'details.bathrooms.integer'        => 'Numri i banjove duhet të jetë numër i plotë.',
            'details.floor.integer'            => 'Kati duhet të jetë numër i plotë.',
            'details.total_roommates.integer'  => 'Numri i bashkëjetuesve duhet të jetë numër i plotë.',
            'details.balcony.boolean'          => 'Ballkoni duhet të jetë po ose jo.',
            'details.veranda.boolean'          => 'Veranda duhet të jetë po ose jo.',
            'details.garden.boolean'           => 'Kopshti duhet të jetë po ose jo.',
            'details.room_available.boolean'   => 'Fusha dhomë e lirë duhet të jetë po ose jo.',
            'details.student_only.boolean'     => 'Vetëm studentë duhet të jetë po ose jo.',
            'details.gender_preference.in'     => 'Preferenca e gjinisë duhet të jetë: mashkull, femër ose çdo.',

            // Exists
            'details.year_build_id.exists'     => 'Viti i ndërtimit i zgjedhur nuk është i vlefshëm.',
            'details.condition_id.exists'      => 'Gjendja e zgjedhur nuk është e vlefshme.',
            'details.furnishing_id.exists'     => 'Mobilimi i zgjedhur nuk është i vlefshëm.',
            'details.orientation_id.exists'    => 'Orientimi i zgjedhur nuk është i vlefshëm.',
            'details.heating_id.exists'        => 'Ngrohja e zgjedhur nuk është e vlefshme.',
            'details.apartment_type_id.exists' => 'Tipi i apartamentit i zgjedhur nuk është i vlefshëm.',
            'details.bedrooms.min'        => 'Numri i dhomave të gjumit nuk mund të jetë më pak se :min.',
            'details.bathrooms.min'       => 'Numri i banjove nuk mund të jetë më pak se :min.',
            'details.floor.min'           => 'Kati nuk mund të jetë më pak se :min.',
            'details.total_roommates.min' => 'Numri i bashkëjetuesve duhet të jetë të paktën :min.',
        ];
    }
}
