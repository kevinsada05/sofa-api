<?php

namespace App\Http\Requests\Listings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use App\Models\TransactionType;

class BaseListingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'city_id'             => ['required', 'exists:cities,id'],
            'transaction_type_id' => ['required', 'exists:transaction_types,id'],
            'ownership_id'        => ['required', 'exists:ownerships,id'],
            'rent_period_id'      => [
                Rule::requiredIf(
                    optional(TransactionType::find(request()->transaction_type_id))->code === 'rent'
                ),
                'nullable',
                'exists:rent_periods,id',
            ],
            'price'               => ['required', 'integer', 'min:1'],
            'negotiable'          => ['required', 'boolean'],
            'size_m2'             => ['required', 'numeric', 'min:1'],
            'address'             => ['required', 'string', 'max:255'],
            'description'         => ['required', 'string', 'max:20000'],
            'images'              => ['nullable', 'array'],
            'images_temp' => ['nullable', 'string'], // contains JSON array of paths
        ];
    }

    public function attributes(): array
    {
        return [
            'city_id'             => 'Qyteti',
            'transaction_type_id' => 'Tipi',
            'ownership_id'        => 'Pronësia',
            'rent_period_id'      => 'Periudha e qirasë',
            'price'               => 'Çmimi',
            'negotiable'          => 'Çmimi i diskutueshëm',
            'size_m2'             => 'Sipërfaqja (m²)',
            'address'             => 'Adresa',
            'description'         => 'Përshkrimi',
            'images'              => 'Fotot shtesë',
            'images.*'            => 'Foto',
        ];
    }

    public function messages(): array
    {
        return [
            // Required
            'city_id.required'             => 'Ju lutem zgjidhni qytetin.',
            'transaction_type_id.required' => 'Ju lutem zgjidhni tipin e transaksionit.',
            'ownership_id.required'        => 'Ju lutem zgjidhni pronësinë.',
            'rent_period_id.required'      => 'Ju lutem zgjidhni periudhën e qirasë.',
            'price.required'               => 'Ju lutem vendosni çmimin.',
            'negotiable.required'          => 'Ju lutem specifikoni nëse çmimi është i diskutueshëm ose jo.',
            'size_m2.required'             => 'Ju lutem vendosni sipërfaqen.',
            'address.required'             => 'Ju lutem vendosni adresën.',
            'description.required'         => 'Ju lutem vendosni përshkrimin.',

            // Type / Format
            'price.integer'                => 'Çmimi duhet të jetë numër i plotë.',
            'price.min'                    => 'Çmimi duhet të jetë së paku 1 EUR.',
            'size_m2.numeric'              => 'Sipërfaqja duhet të jetë numër.',
            'size_m2.min'                  => 'Sipërfaqja duhet të jetë së paku 1 m².',
            'negotiable.boolean'           => 'Çmimi i diskutueshëm duhet të jetë po ose jo.',
            'address.string'               => 'Adresa duhet të jetë tekst.',
            'address.max'                  => 'Adresa nuk mund të jetë më e gjatë se 255 karaktere.',
            'description.string'           => 'Përshkrimi duhet të jetë tekst.',
            'description.max'              => 'Përshkrimi është tepër i gjatë.',
            'primary_image_temp.string'    => 'Fotoja kryesore duhet të jetë një rrugë e vlefshme e skedarit.',
            'images.array'                 => 'Fotot shtesë duhet të jenë një listë e vlefshme.',
            'images_temp.string'           => 'Fotot shtesë duhet të jenë një JSON i vlefshëm.',

            // Exists
            'city_id.exists'               => 'Qyteti i zgjedhur nuk është i vlefshëm.',
            'transaction_type_id.exists'   => 'Tipi i zgjedhur nuk është i vlefshëm.',
            'ownership_id.exists'          => 'Pronësia e zgjedhur nuk është e vlefshme.',
            'rent_period_id.exists'        => 'Periudha e qirasë e zgjedhur nuk është e vlefshme.',
        ];
    }
}
