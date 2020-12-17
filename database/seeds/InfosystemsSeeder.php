<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Infosystem;

class InfosystemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('infosystems')->delete();

        $faker = Faker::create();
        foreach (range(1,100) as $index) {
            Infosystem::create([
                'uuid' => $faker->uuid,
                'position' => 1,
                'appearance' => 1,
                'lang' => 1,
                'tagtype' => $index,
                'tagtext' => 'Text '.$index,
                'tagdate' => '2019-01-29',
                'header' => 'Überschrift '.$index,
                'content' => 'content deutsch '.$index,
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'active' => 1
            ]);
        }

        $faker = Faker::create();
        foreach (range(1,100) as $index) {
            DB::table('infosystems')->insert([
                'uuid' => str_random(8),
                'position' => 1,
                'appearance' => 1,
                'lang' => 2,
                'tagtype' => 5,
                'tagtext' => $faker->word,
                'tagdate' => '2019-01-29',
                'header' => str_random(8),
                'content' => $faker->paragraph,
                'created_at' => '2019-03-24 10:01:30',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'active' => 1
            ]);
        }
    }
}
