<?php

use Illuminate\Database\Seeder;
use App\Models\Inoculation;

class InoculationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inoculations')->delete();

        Inoculation::create([
            'uuid' => '123',
            'assignto' => 1,
            'idversionbefore' => 0,
            'idversionnext' => 0,
            'version' => 1,
            'importantchange' => 1,
            'checkedandok' => 0,
            'checkedandnotok' => 0,
            'countrytocode' => 'EG',
            'country_id' => 2,
            'pregnant' => 0,
            'child' => 0,
            'yf' => 0,
            'linkresource' => '',
            'textresource' => '',
            'active' => 1,
            'archive' => 0,
            'created_user' => 1,
            'created_ip' => '127.0.0.1',
        ]);
        Inoculation::create([
            'uuid' => '456',
            'assignto' => 2,
            'idversionbefore' => 0,
            'idversionnext' => 0,
            'version' => 1,
            'importantchange' => 1,
            'checkedandok' => 0,
            'checkedandnotok' => 0,
            'countrytocode' => 'AX',
            'country_id' => 3,
            'pregnant' => 0,
            'child' => 0,
            'yf' => 0,
            'linkresource' => '',
            'textresource' => '',
            'active' => 1,
            'archive' => 0,
            'created_user' => 1,
            'created_ip' => '127.0.0.1',
        ]);
    }
}
