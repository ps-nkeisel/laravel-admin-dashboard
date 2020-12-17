<?php

use Illuminate\Database\Seeder;

use App\Models\Inoculation;
use App\Models\Inooptionchild;

class InooptchildmatchsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        DB::table('inooptchildmatch')->delete();

        $inoculation = Inoculation::find(1);
        $inooptionchild_ids = [1, 2];
        foreach ($inooptionchild_ids as $inooptionchild_id) {
            $inooptionchild = Inooptionchild::find($inooptionchild_id);
            $inoculation->optionchildren()->save($inooptionchild, [
                'active' => 1,
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'version' => 1,
            ]);
        }
        */
    }
}
