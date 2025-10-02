<?php

namespace App\Http\Requests\Listings;

use Illuminate\Foundation\Http\FormRequest;

class BusinessRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'details.business_types'      => ['required', 'array'],
            'details.business_types.*'    => ['exists:business_types,id'],
            'details.business_name'       => ['nullable', 'string', 'max:255'],
            'details.established_year'    => ['nullable', 'integer', 'digits:4', 'min:1500', 'max:' . date('Y')],
            'details.employees'           => ['nullable', 'integer', 'min:0'],
            'details.on_main_street'      => ['required', 'boolean'],
            'details.parking'             => ['required', 'boolean'],
            'details.floors'              => ['required', 'integer', 'min:0'],
            'details.bathrooms'           => ['required', 'integer', 'min:0'],
            'details.kitchen'             => ['required', 'boolean'],
            'details.outdoor_area'        => ['required', 'boolean'],
            'details.storage_room'        => ['required', 'boolean'],
            'details.alarm_system'        => ['required', 'boolean'],
            'details.fire_safety'         => ['required', 'boolean'],
            'details.handicap_accessible' => ['required', 'boolean'],
            'details.equipment_included'  => ['required', 'boolean'],
            'details.inventory_included'  => ['required', 'boolean'],
            'details.license_included'    => ['required', 'boolean'],
            'details.franchise'           => ['required', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'details.business_type_id'    => 'Lloji i biznesit',
            'details.business_name'       => 'Emri i biznesit',
            'details.established_year'    => 'Viti i themelimit',
            'details.employees'           => 'Numri i punonjësve',
            'details.on_main_street'      => 'Në rrugë kryesore',
            'details.parking'             => 'Parkim',
            'details.floors'              => 'Numri i Kateve',
            'details.bathrooms'           => 'Banjo',
            'details.kitchen'             => 'Kuzhinë',
            'details.outdoor_area'        => 'Hapësirë e jashtme',
            'details.storage_room'        => 'Depo',
            'details.alarm_system'        => 'Sistem alarmi',
            'details.fire_safety'         => 'Sistem kundër zjarrit',
            'details.handicap_accessible' => 'Akses për persona me aftësi të kufizuara',
            'details.equipment_included'  => 'Pajisje të përfshira',
            'details.inventory_included'  => 'Inventar i përfshirë',
            'details.license_included'    => 'Licenca e përfshirë',
            'details.franchise'           => 'Franchise',
        ];
    }

    public function messages(): array
    {
        return [
            // Required
            'details.business_type_id.required'    => 'Ju lutem zgjidhni llojin e biznesit.',
            'details.on_main_street.required'      => 'Ju lutem specifikoni nëse është në rrugë kryesore.',
            'details.parking.required'             => 'Ju lutem specifikoni nëse ka parkim.',
            'details.floors.required'              => 'Ju lutem vendosni numrin e Numrin e Kateve.',
            'details.bathrooms.required'           => 'Ju lutem vendosni numrin e banjove.',
            'details.kitchen.required'             => 'Ju lutem specifikoni nëse ka kuzhinë.',
            'details.outdoor_area.required'        => 'Ju lutem specifikoni nëse ka hapësirë të jashtme.',
            'details.storage_room.required'        => 'Ju lutem specifikoni nëse ka depo.',
            'details.alarm_system.required'        => 'Ju lutem specifikoni nëse ka sistem alarmi.',
            'details.fire_safety.required'         => 'Ju lutem specifikoni nëse ka Sistem kundër zjarrit.',
            'details.handicap_accessible.required' => 'Ju lutem specifikoni nëse ka akses për persona me aftësi të kufizuara.',
            'details.equipment_included.required'  => 'Ju lutem specifikoni nëse pajisjet janë të përfshira.',
            'details.inventory_included.required'  => 'Ju lutem specifikoni nëse inventari është i përfshirë.',
            'details.license_included.required'    => 'Ju lutem specifikoni nëse licenca është e përfshirë.',
            'details.franchise.required'           => 'Ju lutem specifikoni nëse është franchise.',

            // Exists
            'details.business_type_id.exists'      => 'Lloji i biznesit i zgjedhur nuk është i vlefshëm.',

            // Limits
            'details.business_name.max'            => 'Emri i biznesit nuk mund të jetë më i gjatë se 255 karaktere.',
            'details.established_year.digits'      => 'Viti i themelimit duhet të përmbajë saktësisht 4 shifra.',
            'details.established_year.min'         => 'Viti i themelimit nuk mund të jetë më i vogël se 1800.',
            'details.established_year.max'         => 'Viti i themelimit nuk mund të jetë më i madh se viti aktual.',
            'details.employees.integer'            => 'Numri i punonjësve duhet të jetë numër.',
            'details.employees.min'                => 'Numri i punonjësve nuk mund të jetë negativ.',
            'details.floors.integer'               => 'Numri i kateve duhet të jetë numër i plotë.',
            'details.floors.min'                   => 'Numri i kateve nuk mund të jetë negativ.',
            'details.bathrooms.integer'            => 'Numri i banjove duhet të jetë numër i plotë.',
            'details.bathrooms.min'                => 'Numri i banjove nuk mund të jetë negativ.',

            // Boolean
            'details.on_main_street.boolean'       => 'Vlera për rrugë kryesore duhet të jetë po ose jo.',
            'details.parking.boolean'              => 'Parkimi duhet të jetë po ose jo.',
            'details.kitchen.boolean'              => 'Kuzhina duhet të jetë po ose jo.',
            'details.outdoor_area.boolean'         => 'Hapësira e jashtme duhet të jetë po ose jo.',
            'details.storage_room.boolean'         => 'Depo duhet të jetë po ose jo.',
            'details.alarm_system.boolean'         => 'Sistemi i alarmit duhet të jetë po ose jo.',
            'details.fire_safety.boolean'          => 'Sistem kundër zjarrit duhet të jetë po ose jo.',
            'details.handicap_accessible.boolean'  => 'Aksesi për persona me aftësi të kufizuara duhet të jetë po ose jo.',
            'details.equipment_included.boolean'   => 'Pajisjet e përfshira duhet të jenë po ose jo.',
            'details.inventory_included.boolean'   => 'Inventari i përfshirë duhet të jetë po ose jo.',
            'details.license_included.boolean'     => 'Licenca e përfshirë duhet të jetë po ose jo.',
            'details.franchise.boolean'            => 'Franchise duhet të jetë po ose jo.',
            'details.business_types.required'      => 'Ju lutem zgjidhni llojin e biznesit.',
            'details.business_types.array'         => 'Lloji i biznesit duhet të jetë listë e vlefshme.',
            'details.business_types.*.exists'      => 'Një nga llojet e biznesit të zgjedhur nuk është i vlefshëm.',
            'details.business_name.string'         => 'Emri i biznesit duhet të jetë tekst.',
            'details.established_year.integer'     => 'Viti i themelimit duhet të jetë numër.',
        ];
    }
}
