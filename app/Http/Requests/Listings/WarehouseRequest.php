<?php

namespace App\Http\Requests\Listings;

use Illuminate\Foundation\Http\FormRequest;

class WarehouseRequest extends FormRequest
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
            'details.floor_height_m' => ['required', 'integer', 'min:1'],
            'details.parking'        => ['required', 'boolean'],
            'details.loading_dock'   => ['required', 'boolean'],
            'details.water'          => ['required', 'boolean'],
            'details.security'       => ['required', 'boolean'],
            'details.office_space'   => ['required', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'details.year_build_id'  => 'Viti i ndërtimit',
            'details.condition_id'   => 'Gjendja',
            'details.floor_height_m' => 'Lartësia e katit (m)',
            'details.parking'        => 'Parkimi',
            'details.loading_dock'   => 'Mbajtëse për paleta',
            'details.water'          => 'Akses në furnizim me ujë',
            'details.security'       => 'Sistem Sigurie',
            'details.office_space'   => 'Hapësira Për zyrë',
        ];
    }

    public function messages(): array
    {
        return [
            // Required
            'details.year_build_id.required'  => 'Ju lutem zgjidhni vitin e ndërtimit.',
            'details.condition_id.required'   => 'Ju lutem zgjidhni gjendjen.',
            'details.floor_height_m.required' => 'Ju lutem vendosni lartësinë e katit.',
            'details.parking.required'        => 'Ju lutem specifikoni nëse ka parkim.',
            'details.loading_dock.required'   => 'Ju lutem specifikoni nëse ka platformë ngarkimi.',
            'details.water.required'          => 'Ju lutem specifikoni nëse ka Akses në furnizim me ujë.',
            'details.security.required'       => 'Ju lutem specifikoni nëse ka Sistem Sigurie.',
            'details.office_space.required'   => 'Ju lutem specifikoni nëse ka Hapësira Për Zyrë.',

            // Type / value
            'details.floor_height_m.integer'  => 'Lartësia e katit duhet të jetë numër i plotë.',
            'details.floor_height_m.min'      => 'Lartësia e katit duhet të jetë të paktën 1 metër.',
            'details.parking.boolean'         => 'Parkimi duhet të jetë po ose jo.',
            'details.loading_dock.boolean'    => 'Mbajtëse për paleta duhet të jetë po ose jo.',
            'details.water.boolean'           => 'Akses në furnizim me ujë duhet të jetë po ose jo.',
            'details.security.boolean'        => 'Siguria duhet të jetë po ose jo.',
            'details.office_space.boolean'    => 'Hapësira e zyrës duhet të jetë po ose jo.',

            // Exists
            'details.year_build_id.exists'    => 'Viti i ndërtimit i zgjedhur nuk është i vlefshëm.',
            'details.condition_id.exists'     => 'Gjendja e zgjedhur nuk është e vlefshme.',

        ];
    }
}
