<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('apartment_types')->insert([
            ['name' => '1+1', 'code' => '1_1'],
            ['name' => '2+1', 'code' => '2_1'],
            ['name' => '3+1', 'code' => '3_1'],
            ['name' => '4+1', 'code' => '4_1'],
            ['name' => '5+1', 'code' => '5_1'],
            ['name' => 'Studio', 'code' => 'studio'],
            ['name' => 'Duplex', 'code' => 'duplex'],
        ]);

        DB::table('business_types')->insert([
            ['name' => 'Restorant', 'code' => 'restaurant'],
            ['name' => 'Bar / Kafe', 'code' => 'bar_cafe'],
            ['name' => 'Piceri', 'code' => 'pizzeria'],
            ['name' => 'Fast Food', 'code' => 'fast_food'],
            ['name' => 'Hotel', 'code' => 'hotel'],
            ['name' => 'Hostel', 'code' => 'hostel'],
            ['name' => 'Kamp / Agroturizëm', 'code' => 'camp_agrotourism'],
            ['name' => 'Qendër Interneti', 'code' => 'internet_center'],
            ['name' => 'Kioske', 'code' => 'kiosk'],
            ['name' => 'Tabakino', 'code' => 'tobacco_shop'],
            ['name' => 'Market', 'code' => 'market'],
            ['name' => 'Pastiçeri', 'code' => 'pastry_shop'],
            ['name' => 'Lavanderi', 'code' => 'laundry'],
            ['name' => 'Dyqan Rrobash', 'code' => 'clothing_store'],
            ['name' => 'Dyqan Celularesh', 'code' => 'mobile_store'],
            ['name' => 'Berberhane', 'code' => 'barbershop'],
            ['name' => 'Sallon Bukurie / Estetikë', 'code' => 'beauty_salon'],
            ['name' => 'Spa / Masazh', 'code' => 'spa'],
            ['name' => 'Palestra', 'code' => 'gym'],
            ['name' => 'Lavazh', 'code' => 'car_wash'],
            ['name' => 'Servis Makinash', 'code' => 'car_service'],
            ['name' => 'Gomisteri', 'code' => 'tire_shop'],
            ['name' => 'Farmaci', 'code' => 'pharmacy'],
            ['name' => 'Klinikë', 'code' => 'clinic'],
            ['name' => 'Agjensi Turistike', 'code' => 'travel_agency'],
            ['name' => 'Agjensi Imobiliare', 'code' => 'real_estate_agency'],
            ['name' => 'Depo / Magazinë', 'code' => 'warehouse'],
            ['name' => 'Kompani Transporti', 'code' => 'transport_company'],
            ['name' => 'Treg i Hapur / Tezgë', 'code' => 'open_market'],
            ['name' => 'Qendër Sportive', 'code' => 'sports_center'],
            ['name' => 'Tjetër', 'code' => 'other'],
            ['name' => 'Për çdo lloj aktiviteti', 'code' => 'all_activities'],
        ]);

        DB::table('categories')->insert([
            ['name' => 'Apartament', 'code' => 'apartment'],
            ['name' => 'Vilë', 'code' => 'villa'],
            ['name' => 'Garsoniere', 'code' => 'garsoniere'],
            ['name' => 'Penthouse', 'code' => 'penthouse'],
            ['name' => 'Ndarje Qiraje', 'code' => 'shared_rent'],
            ['name' => 'Parkim', 'code' => 'garage'],
            ['name' => 'Dyqan', 'code' => 'shop'],
            ['name' => 'Zyrë', 'code' => 'office'],
            ['name' => 'Magazinë', 'code' => 'warehouse'],
            ['name' => 'Biznes', 'code' => 'business'],
            ['name' => 'Truall', 'code' => 'plot'],
            ['name' => 'Tokë Bujqësore', 'code' => 'agricultural_land'],
        ]);

        DB::table('cities')->insert([
                ['name' => 'Ballsh'],
                ['name' => 'Bajram Curri'],
                ['name' => 'Berat'],
                ['name' => 'Bilisht'],
                ['name' => 'Bulqizë'],
                ['name' => 'Burrel'],
                ['name' => 'Cërrik'],
                ['name' => 'Çorovodë'],
                ['name' => 'Delvinë'],
                ['name' => 'Divjakë'],
                ['name' => 'Durrës'],
                ['name' => 'Elbasan'],
                ['name' => 'Ersekë'],
                ['name' => 'Fier'],
                ['name' => 'Fushë-Arrëz'],
                ['name' => 'Fushë-Krujë'],
                ['name' => 'Gjirokastër'],
                ['name' => 'Gramsh'],
                ['name' => 'Himarë'],
                ['name' => 'Kamëz'],
                ['name' => 'Kavajë'],
                ['name' => 'Këlcyrë'],
                ['name' => 'Koplik'],
                ['name' => 'Korçë'],
                ['name' => 'Konispol'],
                ['name' => 'Krujë'],
                ['name' => 'Krastë'],
                ['name' => 'Krumë'],
                ['name' => 'Kuçovë'],
                ['name' => 'Kukës'],
                ['name' => 'Laç'],
                ['name' => 'Lezhë'],
                ['name' => 'Libohovë'],
                ['name' => 'Librazhd'],
                ['name' => 'Lushnjë'],
                ['name' => 'Mamurras'],
                ['name' => 'Maliq'],
                ['name' => 'Milot'],
                ['name' => 'Memaliaj'],
                ['name' => 'Patos'],
                ['name' => 'Peqin'],
                ['name' => 'Përmet'],
                ['name' => 'Përrenjas'],
                ['name' => 'Peshkopi'],
                ['name' => 'Poliçan'],
                ['name' => 'Pogradec'],
                ['name' => 'Pukë'],
                ['name' => 'Rrëshen'],
                ['name' => 'Rrogozhinë'],
                ['name' => 'Roskovec'],
                ['name' => 'Rubik'],
                ['name' => 'Sarandë'],
                ['name' => 'Selenicë'],
                ['name' => 'Shëngjin'],
                ['name' => 'Shijak'],
                ['name' => 'Shkodër'],
                ['name' => 'Tepelenë'],
                ['name' => 'Tiranë'],
                ['name' => 'Ura Vajgurore (Dimal)'],
                ['name' => 'Vlorë'],
                ['name' => 'Vorë'],
        ]);

        DB::table('conditions')->insert([
            ['name' => 'E Re', 'code' => 'new'],
            ['name' => 'Në Gjendje Të Mirë', 'code' => 'good_condition'],
            ['name' => 'Nevojitet Rikonstruksion', 'code' => 'needs_renovation'],
            ['name' => 'Në Ndërtim', 'code' => 'under_construction'],
            ['name' => 'E Rikonstruktuar', 'code' => 'renovated'],
        ]);

        DB::table('furnishings')->insert([
            ['name' => 'E Mobiluar Plotësisht', 'code' => 'fully_furnished'],
            ['name' => 'E Mobiluar Pjesërisht', 'code' => 'partly_furnished'],
            ['name' => 'E Pamobiluar', 'code' => 'unfurnished'],
        ]);

        DB::table('heatings')->insert([
            ['name' => 'Qëndrore', 'code' => 'central'],
            ['name' => 'Individuale', 'code' => 'individual'],
            ['name' => 'Kondicioner', 'code' => 'air_conditioner'],
            ['name' => 'Asnjë', 'code' => 'none'],
        ]);

        DB::table('land_types')->insert([
            ['name' => 'Fushë', 'code' => 'field'],
            ['name' => 'Malore', 'code' => 'mountain'],
            ['name' => 'Kodrinore', 'code' => 'hilly'],
            ['name' => 'Pyjore', 'code' => 'forest'],
            ['name' => 'Bregdetare', 'code' => 'coastal'],
        ]);

        DB::table('orientations')->insert([
            ['name' => 'Veri', 'code' => 'north'],
            ['name' => 'Jug', 'code' => 'south'],
            ['name' => 'Lindje', 'code' => 'east'],
            ['name' => 'Perëndim', 'code' => 'west'],
            ['name' => 'Veri-Lindje', 'code' => 'north_east'],
            ['name' => 'Veri-Perëndim', 'code' => 'north_west'],
            ['name' => 'Jug-Lindje', 'code' => 'south_east'],
            ['name' => 'Jug-Perëndim', 'code' => 'south_west'],
        ]);

        DB::table('ownerships')->insert([
            ['name' => 'Me Dokumenta', 'code' => 'with_certificate'],
            ['name' => 'Në proces hipotekimi', 'code' => 'in_process'],
            ['name' => 'Pa dokumenta', 'code' => 'no_documents'],
        ]);

        DB::table('rent_periods')->insert([
            ['name' => 'Ditore', 'code' => 'daily'],
            ['name' => 'Mujore', 'code' => 'monthly'],
        ]);

        DB::table('soil_qualities')->insert([
            ['name' => 'Shumë e mirë', 'code' => 'excellent'],
            ['name' => 'Mesatare', 'code' => 'average'],
            ['name' => 'Dobët', 'code' => 'poor'],
        ]);

        DB::table('statuses')->insert([
            ['name' => 'Aktive', 'code' => 'active'],
            ['name' => 'Draft', 'code' => 'draft'],
            ['name' => 'Në Rishikim', 'code' => 'review'],
            ['name' => 'Skaduar', 'code' => 'expired'],
            ['name' => 'Anuluar', 'code' => 'cancelled'],
        ]);

        DB::table('terrain_types')->insert([
            ['name' => 'Rrafshët', 'code' => 'flat'],
            ['name' => 'Kodrinor', 'code' => 'hilly'],
            ['name' => 'Malor', 'code' => 'mountain'],
            ['name' => 'Pjerrët', 'code' => 'steep'],
        ]);

        DB::table('transaction_types')->insert([
            ['name' => 'Qira', 'code' => 'rent'],
            ['name' => 'Shitje', 'code' => 'sale'],
        ]);

        DB::table('user_types')->insert([
            ['name' => 'Individ', 'code' => 'individual'],
            ['name' => 'Biznes', 'code' => 'business'],
            ['name' => 'Agjent Imobiliar', 'code' => 'agency'],
        ]);


        DB::table('year_builds')->insert([
            ['name' => 'Para 1990', 'code' => 'before_1990'],
            ['name' => '1990 - 2000', 'code' => '1990_2000'],
            ['name' => '2000 - 2010', 'code' => '2000_2010'],
            ['name' => '2010 - 2015', 'code' => '2010_2015'],
            ['name' => '2016 - 2020', 'code' => '2016_2020'],
            ['name' => '2021+', 'code' => '2021_plus'],
        ]);


        DB::table('users')->insert([
            'phone' => '+355692604998',
            'user_type_id' => 1,
            'password' => Hash::make('acdczztop001!?K'),
            'is_admin' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
