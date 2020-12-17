<?php

use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->delete();
        DB::table('languages')->insert(array (
            0 =>
                array(
                    'position' => 1,
                    'code' => 'de',
                    'language' => 'en',
                    'content' => 'German',
                    'created_at' => '2019-03-24 22:01:30',
                    'created_ip' => '127.0.0.1',
                    'created_user' => 1,
                    'active' => 1
                ),
            1 =>
                array(
                    'position' => 2,
                    'code' => 'en',
                    'language' => 'en',
                    'content' => 'Englisch',
                    'created_at' => '2019-03-24 22:01:30',
                    'created_ip' => '127.0.0.1',
                    'created_user' => 1,
                    'active' => 1
                ),
            2 =>
                array(
                    'position' => 3,
                    'code' => 'fr',
                    'language' => 'en',
                    'content' => 'French',
                    'created_at' => '2019-03-24 22:01:30',
                    'created_ip' => '127.0.0.1',
                    'created_user' => 1,
                    'active' => 1
                ),
            3 =>
                array(
                    'ppositionos' => 4,
                    'code' => 'it',
                    'language' => 'en',
                    'content' => 'Italian',
                    'created_at' => '2019-03-24 22:01:30',
                    'created_ip' => '127.0.0.1',
                    'created_user' => 1,
                    'active' => 1
                ),
            4 =>
                array(
                    'position' => 5,
                    'code' => 'nl',
                    'language' => 'en',
                    'content' => 'Dutch',
                    'created_at' => '2019-03-24 22:01:30',
                    'created_ip' => '127.0.0.1',
                    'created_user' => 1,
                    'active' => 1
                ),
            5 =>
                array(
                    'position' => 6,
                    'code' => 'pl',
                    'language' => 'en',
                    'content' => 'Polish',
                    'created_at' => '2019-03-24 22:01:30',
                    'created_ip' => '127.0.0.1',
                    'created_user' => 1,
                    'active' => 1
                ),
            6 =>
                array(
                    'position' => 7,
                    'code' => 'es',
                    'language' => 'en',
                    'content' => 'Spanish',
                    'created_at' => '2019-03-24 22:01:30',
                    'created_ip' => '127.0.0.1',
                    'created_user' => 1,
                    'active' => 1
                ),
            7 =>
                array(
                    'position' => 8,
                    'code' => 'pt',
                    'language' => 'en',
                    'content' => 'Portuguese',
                    'created_at' => '2019-03-24 22:01:30',
                    'created_ip' => '127.0.0.1',
                    'created_user' => 1,
                    'active' => 1
                ),
            8 =>
                array(
                    'position' => 9,
                    'code' => 'ru',
                    'language' => 'en',
                    'content' => 'Russian',
                    'created_at' => '2019-03-24 22:01:30',
                    'created_ip' => '127.0.0.1',
                    'created_user' => 1,
                    'active' => 1
                ),
        ));
    }
}
