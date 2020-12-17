<?php

use Illuminate\Database\Seeder;
use App\Models\Inoculationspecific;

class InoculationspecificsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inoculationspecifics')->delete();

        Inoculationspecific::create([
            'position' => 1,
            'content' => 'Yellowfever',
            'contentcode' => 'YF'
        ]);
        Inoculationspecific::create([
            'position' => 2,
            'content' => 'Malaria',
            'contentcode' => 'ML'
        ]);
        Inoculationspecific::create([
            'position' => 3,
            'content' => 'Measles',
            'contentcode' => 'MS'
        ]);
        Inoculationspecific::create([
            'position' => 4,
            'content' => 'HIV',
            'contentcode' => 'HIV'
        ]);
    }
}
