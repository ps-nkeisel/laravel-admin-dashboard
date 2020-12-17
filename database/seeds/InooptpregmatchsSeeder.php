<?php

use Illuminate\Database\Seeder;

use App\Models\Inoculation;
use App\Models\Inooptionpregnant;

class InooptpregmatchsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        DB::table('inooptpregmatch')->delete();

        $inoculation = Inoculation::find(1);
        $inooptionpregnant_ids = [1, 2];
        foreach ($inooptionpregnant_ids as $inooptionpregnant_id) {
            $inooptionpregnant = Inooptionpregnant::find($inooptionpregnant_id);
            $inoculation->optionpregnants()->save($inooptionpregnant, [
                'active' => 1,
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'version' => 1,
            ]);
        }
        */
    }
}
