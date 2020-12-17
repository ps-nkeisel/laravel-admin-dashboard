<?php

use Illuminate\Database\Seeder;
use App\Models\Inooptionchild;

class InooptionchildrenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inooptionchildren')->delete();

        Inooptionchild::create([
            'position' => 1,
            'content' => 'Dengue fever'
        ]);
        Inooptionchild::create([
            'position' => 2,
            'content' => 'HFMD'
        ]);
    }
}
