<?php

use Illuminate\Database\Seeder;

use App\Models\Inoculation;
use App\Models\Immunisation;

class InoimmumatchsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        DB::table('inoimmumatch')->delete();

        $inoculation = Inoculation::find(1);
        $requirement_immunisation_ids = [10, 11, 12, 13];
        foreach ($requirement_immunisation_ids as $requirement_immunisation_id) {
            $immunisation = Immunisation::find($requirement_immunisation_id);
            $inoculation->requirement_immunisations()->save($immunisation, [
                'active' => 1, 
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'version' => 1,
            ]);
        }
        $recommendation_immunisation_ids = [14, 18];
        foreach ($recommendation_immunisation_ids as $recommendation_immunisation_id) {
            $immunisation = Immunisation::find($recommendation_immunisation_id);
            $inoculation->recommendation_immunisations()->save($immunisation, [
                'active' => 1, 
                'longtermstay' => 1,
                'specialexposure' => 1,
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'version' => 1,
            ]);
        }
        */
    }
}
