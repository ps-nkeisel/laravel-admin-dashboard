<?php

use Illuminate\Database\Seeder;

use App\Models\Inoculation;
use App\Models\Inoculationspecific;

class InooptspecmatchsSeeder extends Seeder
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
        $inoculationspecific_ids = [3, 4];
        foreach ($inoculationspecific_ids as $inoculationspecific_id) {
            $inoculationspecific = Inoculationspecific::find($inoculationspecific_id);
            $inoculation->inoculationspecifics()->save($inoculationspecific, [
                'active' => 1,
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'version' => 1,
            ]);
        }
        */
    }
}
