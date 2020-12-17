<?php

use Illuminate\Database\Seeder;
use App\Models\Inooptionpregnant;

class InooptionpregnantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inooptionpregnants')->delete();

        Inooptionpregnant::create([
            'position' => 1,
            'content' => 'Zika virus'
        ]);
        Inooptionpregnant::create([
            'position' => 2,
            'content' => 'Chikungunya fever'
        ]);
    }
}
