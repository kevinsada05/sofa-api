<?php

namespace App\Http\Requests\Listings;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'details.year_build_id'   => ['required', 'exists:year_builds,id'],
            'details.condition_id'    => ['required', 'exists:conditions,id'],
            'details.furnishing_id'   => ['required', 'exists:furnishings,id'],
            'details.orientation_id'  => ['required', 'exists:orientations,id'],
            'details.heating_id'      => ['required', 'exists:heatings,id'],
            'details.parking'         => ['required', 'boolean'],
            'details.warehouse'       => ['required', 'boolean'],
            'details.bathrooms'       => ['required', 'integer', 'min:0'],
            'details.floor'           => ['required', 'integer'],
            'details.main_street'     => ['required', 'boolean'],
            'details.corner_location' => ['required', 'boolean'],
            'details.double_facade'   => ['required', 'boolean'],
            'details.electricity'     => ['required', 'boolean'],
            'details.water_supply'    => ['required', 'boolean'],
            'details.ventilation'     => ['required', 'boolean'],
            'details.fire_safety'     => ['required', 'boolean'],
            'details.ceiling_height_m'=> ['required', 'numeric', 'min:1'],
        ];
    }

    public function attributes(): array
    {
        return [
            'details.year_build_id'   => 'Viti i ndërtimit',
            'details.condition_id'    => 'Gjendja',
            'details.furnishing_id'   => 'Mobilimi',
            'details.orientation_id'  => 'Orientimi',
            'details.heating_id'      => 'Ngrohja',
            'details.parking'         => 'Parkimi',
            'details.warehouse'       => 'Depo',
            'details.bathrooms'       => 'Banjo',
            'details.floor'           => 'Kati',
            'details.main_street'     => 'Rruga kryesore',
            'details.corner_location' => 'Lokacion në cep',
            'details.double_facade'   => 'Dopio Fasadë',
            'details.electricity'     => 'Energjia elektrike',
            'details.water_supply'    => 'Furnizimi me ujë',
            'details.ventilation'     => 'Ventilim',
            'details.fire_safety'     => 'Sistem kundër zjarrit',
            'details.ceiling_height_m'=> 'Lartësia e tavanit (m)',
        ];
    }

    public function messages(): array
    {
        return [
            // Required
            'details.year_build_id.required'   => 'Ju lutem zgjidhni vitin e ndërtimit.',
            'details.condition_id.required'    => 'Ju lutem zgjidhni gjendjen.',
            'details.furnishing_id.required'   => 'Ju lutem zgjidhni mobilimin.',
            'details.orientation_id.required'  => 'Ju lutem zgjidhni orientimin.',
            'details.heating_id.required'      => 'Ju lutem zgjidhni ngrohjen.',
            'details.parking.required'         => 'Ju lutem specifikoni nëse dyqani ka parkim.',
            'details.warehouse.required'       => 'Ju lutem specifikoni nëse dyqani ka depo.',
            'details.bathrooms.required'       => 'Ju lutem vendosni numrin e banjove.',
            'details.floor.required'           => 'Ju lutem vendosni katin.',
            'details.main_street.required'     => 'Ju lutem specifikoni nëse ndodhet në rrugë kryesore.',
            'details.corner_location.required' => 'Ju lutem specifikoni nëse ndodhet në cep.',
            'details.double_facade.required'   => 'Ju lutem specifikoni nëse ka dopio fasadë.',
            'details.electricity.required'     => 'Ju lutem specifikoni nëse ka energji elektrike.',
            'details.water_supply.required'    => 'Ju lutem specifikoni nëse ka furnizim me ujë.',
            'details.ventilation.required'     => 'Ju lutem specifikoni nëse ka ventilim.',
            'details.fire_safety.required'     => 'Ju lutem specifikoni nëse ka Sistem kundër zjarrit.',
            'details.ceiling_height_m.required'=> 'Ju lutem vendosni lartësinë e tavanit.',

            // Type / value
            'details.bathrooms.integer'        => 'Numri i banjove duhet të jetë numër i plotë.',
            'details.bathrooms.min'            => 'Numri i banjove nuk mund të jetë negativ.',
            'details.floor.integer'            => 'Kati duhet të jetë numër i plotë.',
            'details.parking.boolean'          => 'Parkimi duhet të jetë po ose jo.',
            'details.warehouse.boolean'        => 'Depo duhet të jetë po ose jo.',
            'details.main_street.boolean'      => 'Rruga kryesore duhet të jetë po ose jo.',
            'details.corner_location.boolean'  => 'Lokacioni në cep duhet të jetë po ose jo.',
            'details.double_facade.boolean'    => 'Dopio Fasadë duhet të jetë po ose jo.',
            'details.electricity.boolean'      => 'Energjia elektrike duhet të jetë po ose jo.',
            'details.water_supply.boolean'     => 'Furnizimi me ujë duhet të jetë po ose jo.',
            'details.ventilation.boolean'      => 'Ventilimi duhet të jetë po ose jo.',
            'details.fire_safety.boolean'      => 'Sistem kundër zjarrit duhet të jetë po ose jo.',
            'details.ceiling_height_m.numeric' => 'Lartësia e tavanit duhet të jetë numër.',
            'details.ceiling_height_m.min'     => 'Lartësia e tavanit duhet të jetë të paktën 1 metër.',

            // Exists
            'details.year_build_id.exists'     => 'Viti i ndërtimit i zgjedhur nuk është i vlefshëm.',
            'details.condition_id.exists'      => 'Gjendja e zgjedhur nuk është e vlefshme.',
            'details.furnishing_id.exists'     => 'Mobilimi i zgjedhur nuk është i vlefshëm.',
            'details.orientation_id.exists'    => 'Orientimi i zgjedhur nuk është i vlefshëm.',
            'details.heating_id.exists'        => 'Ngrohja e zgjedhur nuk është e vlefshme.',
            'details.floor'                    => ['required', 'integer'],
        ];
    }
}
