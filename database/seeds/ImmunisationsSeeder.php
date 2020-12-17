<?php

use Illuminate\Database\Seeder;
use App\Models\Immunisation;

class ImmunisationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('immunisations')->delete();

        Immunisation::create([
            'id' => 10,
            'position' => 1,
            'content' => 'Vaccinations according to the current vaccination calendar of the Robert Koch Institute',
            'created_ip' => '127.0.0.1',
            'created_user' => 1,
        ]);
        Immunisation::create([
            'id' => 11,
            'position' => 2,
            'content' => 'Hepatitis A',
            'created_ip' => '127.0.0.1',
            'created_user' => 1,
        ]);
        Immunisation::create([
            'id' => 12,
            'position' => 3,
            'content' => 'Hepatitis B',
            'created_ip' => '127.0.0.1',
            'created_user' => 1,
        ]);
        Immunisation::create([
            'id' => 13,
            'position' => 4,
            'content' => 'Hepatitis C',
            'created_ip' => '127.0.0.1',
            'created_user' => 1,
        ]);
        Immunisation::create([
            'id' => 14,
            'position' => 5,
            'content' => 'Typhoid',
            'created_ip' => '127.0.0.1',
            'created_user' => 1,
        ]);
        Immunisation::create([
            'id' => 15,
            'position' => 6,
            'content' => 'Cholera',
            'created_ip' => '127.0.0.1',
            'created_user' => 1,
        ]);
        Immunisation::create([
            'id' => 16,
            'position' => 7,
            'content' => 'Meningococcal disease (ACWY)',
            'created_ip' => '127.0.0.1',
            'created_user' => 1,
        ]);
        Immunisation::create([
            'id' => 17,
            'position' => 8,
            'content' => 'Rabies',
            'created_ip' => '127.0.0.1',
            'created_user' => 1,
        ]);
        Immunisation::create([
            'id' => 18,
            'position' => 9,
            'content' => 'Bird flu',
            'created_ip' => '127.0.0.1',
            'created_user' => 1,
        ]);
    }
}
