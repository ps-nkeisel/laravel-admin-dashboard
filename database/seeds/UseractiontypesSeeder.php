<?php

use Illuminate\Database\Seeder;
use App\Models\Useractiontype;

class UseractiontypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('useractiontypes')->delete();

        Useractiontype::create([
            'position' => 1,
            'content' => 'Record created'
        ]);
        Useractiontype::create([
            'position' => 2,
            'content' => 'Record changed'
        ]);
        Useractiontype::create([
            'position' => 3,
            'content' => 'Record deleted'
        ]);
        Useractiontype::create([
            'position' => 4,
            'content' => 'Record checked'
        ]);
        Useractiontype::create([
            'position' => 5,
            'content' => 'Record checked and ok'
        ]);
        Useractiontype::create([
            'position' => 6,
            'content' => 'Record checked and not ok'
        ]);
        Useractiontype::create([
            'position' => 7,
            'content' => 'Task created'
        ]);
    }
}
