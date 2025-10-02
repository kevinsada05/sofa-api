<?php

namespace App\Http\Requests\Listings;

use Illuminate\Foundation\Http\FormRequest;

class OfficeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'details.year_build_id'    => ['required', 'exists:year_builds,id'],
            'details.condition_id'     => ['required', 'exists:conditions,id'],
            'details.furnishing_id'    => ['required', 'exists:furnishings,id'],
            'details.orientation_id'   => ['required', 'exists:orientations,id'],
            'details.heating_id'       => ['required', 'exists:heatings,id'],
            'details.bathrooms'        => ['required', 'integer', 'min:0'],
            'details.parking'          => ['required', 'boolean'],
            'details.rooms'            => ['required', 'integer', 'min:1'],
            'details.conference_hall'  => ['required', 'boolean'],
            'details.floor'            => ['required', 'integer'],
            'details.meeting_room'     => ['required', 'boolean'],
            'details.open_space'       => ['required', 'boolean'],
            'details.reception'        => ['required', 'boolean'],
            'details.elevator'         => ['required', 'boolean'],
            'details.internet'         => ['required', 'boolean'],
            'details.air_conditioning' => ['required', 'boolean'],
            'details.kitchenette'      => ['required', 'boolean'],
            'details.security_system'  => ['required', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'details.year_build_id'    => 'Viti i ndërtimit',
            'details.condition_id'     => 'Gjendja',
            'details.furnishing_id'    => 'Mobilimi',
            'details.orientation_id'   => 'Orientimi',
            'details.heating_id'       => 'Ngrohja',
            'details.bathrooms'        => 'Banjo',
            'details.parking'          => 'Parkimi',
            'details.rooms'            => 'Dhoma',
            'details.conference_hall'  => 'Salla konferencash',
            'details.floor'            => 'Kati',
            'details.meeting_room'     => 'Salla takimesh',
            'details.open_space'       => 'Hapësirë e hapur',
            'details.reception'        => 'Recepsioni',
            'details.elevator'         => 'Ashensori',
            'details.internet'         => 'Internet',
            'details.air_conditioning' => 'Kondicioner',
            'details.kitchenette'      => 'Kuzhinë e vogël',
            'details.security_system'  => 'Sistemi i sigurisë',
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
            'details.bathrooms.required'       => 'Ju lutem vendosni numrin e banjove.',
            'details.rooms.required'           => 'Ju lutem vendosni numrin e dhomave.',
            'details.floor.required'           => 'Ju lutem vendosni katin.',
            'details.parking.required'         => 'Ju lutem specifikoni nëse ka parkim.',
            'details.conference_hall.required' => 'Ju lutem specifikoni nëse ka sallë konferencash.',
            'details.meeting_room.required'    => 'Ju lutem specifikoni nëse ka sallë takimesh.',
            'details.open_space.required'      => 'Ju lutem specifikoni nëse ka hapësirë të hapur.',
            'details.reception.required'       => 'Ju lutem specifikoni nëse ka recepsion.',
            'details.elevator.required'        => 'Ju lutem specifikoni nëse ka ashensor.',
            'details.internet.required'        => 'Ju lutem specifikoni nëse ka internet.',
            'details.air_conditioning.required'=> 'Ju lutem specifikoni nëse ka kondicioner.',
            'details.kitchenette.required'     => 'Ju lutem specifikoni nëse ka kuzhinë të vogël.',
            'details.security_system.required' => 'Ju lutem specifikoni nëse ka sistem sigurie.',
            'details.bathrooms.integer'        => 'Numri i banjove duhet të jetë numër i plotë.',
            'details.bathrooms.min'            => 'Numri i banjove nuk mund të jetë negativ.',
            'details.rooms.integer'            => 'Numri i dhomave duhet të jetë numër i plotë.',
            'details.rooms.min'                => 'Numri i dhomave duhet të jetë të paktën 1.',
            'details.floor.integer'            => 'Kati duhet të jetë numër i plotë.',
            'details.parking.boolean'          => 'Parkimi duhet të jetë po ose jo.',
            'details.conference_hall.boolean'  => 'Salla konferencash duhet të jetë po ose jo.',
            'details.meeting_room.boolean'     => 'Salla takimesh duhet të jetë po ose jo.',
            'details.open_space.boolean'       => 'Hapësira e hapur duhet të jetë po ose jo.',
            'details.reception.boolean'        => 'Recepsioni duhet të jetë po ose jo.',
            'details.elevator.boolean'         => 'Ashensori duhet të jetë po ose jo.',
            'details.internet.boolean'         => 'Internet duhet të jetë po ose jo.',
            'details.air_conditioning.boolean' => 'Kondicioneri duhet të jetë po ose jo.',
            'details.kitchenette.boolean'      => 'Kuzhina e vogël duhet të jetë po ose jo.',
            'details.security_system.boolean'  => 'Sistemi i sigurisë duhet të jetë po ose jo.',
            'details.year_build_id.exists'     => 'Viti i ndërtimit i zgjedhur nuk është i vlefshëm.',
            'details.condition_id.exists'      => 'Gjendja e zgjedhur nuk është e vlefshme.',
            'details.furnishing_id.exists'     => 'Mobilimi i zgjedhur nuk është i vlefshëm.',
            'details.orientation_id.exists'    => 'Orientimi i zgjedhur nuk është i vlefshëm.',
            'details.heating_id.exists'        => 'Ngrohja e zgjedhur nuk është e vlefshme.',
            'details.floor.min'                => 'Kati nuk mund të jetë më pak se :min.',
        ];
    }
}
