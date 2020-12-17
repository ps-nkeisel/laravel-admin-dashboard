<?php

use Illuminate\Database\Seeder;
use App\Models\Inoculationchild;

class InoculationchildrenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inoculationchildren')->delete();

        Inoculationchild::create([
            'assignto' => 0,
            'lang' => 1,
            'position' => 1,
            'content' => 'Option 1'
        ]);
        Inoculationchild::create([
            'assignto' => 0,
            'lang' => 1,
            'position' => 1,
            'content' => 'Option 2'
        ]);
    }
}
