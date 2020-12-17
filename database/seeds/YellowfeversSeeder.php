<?php

use Illuminate\Database\Seeder;
use App\Models\Yellowfever;

class YellowfeversSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('yellowfevers')->delete();

        Yellowfever::create([
            'position' => 1,
            'content' => 'risk countries',
        ]);

        Yellowfever::create([
            'position' => 2,
            'content' => 'all countries',
        ]);
    }
}
