<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Inocontent;

class InocontentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inocontents')->delete();

        Inocontent::create([
            'active' => 1,
            'archive' => 0,
            'assignto' => 0,
            'idversionbefore' => 0,
            'idversionnext' => 0,
            'version' => 1,
            'lang' => 2,
            'content1' => '',
            'created_ip' => '127.0.0.1',
            'created_user' => 1,
        ]);
        Inocontent::create([
            'active' => 1,
            'archive' => 0,
            'assignto' => 0,
            'idversionbefore' => 0,
            'idversionnext' => 0,
            'version' => 1,
            'lang' => 2,
            'content1' => '',
            'created_ip' => '127.0.0.1',
            'created_user' => 1,
        ]);
        Inocontent::create([
            'active' => 1,
            'archive' => 0,
            'assignto' => 1,
            'idversionbefore' => 0,
            'idversionnext' => 0,
            'version' => 1,
            'lang' => 1,
            'content1' => 'Das ist ein test textinhalt 1',
            'created_ip' => '127.0.0.1',
            'created_user' => 1,
        ]);
        Inocontent::create([
            'active' => 1,
            'archive' => 0,
            'assignto' => 2,
            'idversionbefore' => 0,
            'idversionnext' => 0,
            'version' => 1,
            'lang' => 1,
            'content1' => 'Das ist ein test textinhalt 2',
            'created_ip' => '127.0.0.1',
            'created_user' => 1,
        ]);
        Inocontent::create([
            'active' => 1,
            'archive' => 0,
            'assignto' => 1,
            'idversionbefore' => 0,
            'idversionnext' => 0,
            'version' => 1,
            'lang' => 2,
            'content1' => 'this is a test content 1',
            'created_ip' => '127.0.0.1',
            'created_user' => 1,
        ]);
        Inocontent::create([
            'active' => 1,
            'archive' => 0,
            'assignto' => 2,
            'idversionbefore' => 0,
            'idversionnext' => 0,
            'version' => 1,
            'lang' => 2,
            'content1' => 'this is a test content 2',
            'created_ip' => '127.0.0.1',
            'created_user' => 1,
        ]);
        Inocontent::create([
            'active' => 1,
            'archive' => 0,
            'assignto' => 1,
            'idversionbefore' => 0,
            'idversionnext' => 0,
            'version' => 1,
            'lang' => 3,
            'content1' => 'Il s\'agit d\'un texte de test dont le contenu est 1',
            'created_ip' => '127.0.0.1',
            'created_user' => 1,
        ]);
        Inocontent::create([
            'active' => 1,
            'archive' => 0,
            'assignto' => 2,
            'idversionbefore' => 0,
            'idversionnext' => 0,
            'version' => 1,
            'lang' => 3,
            'content1' => 'Il s\'agit d\'un texte de test dont le contenu est 2',
            'created_ip' => '127.0.0.1',
            'created_user' => 1,
        ]);
    }
}
