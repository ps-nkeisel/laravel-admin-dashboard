<?php

use Illuminate\Database\Seeder;
use App\Models\Useractionsection;

class UseractionsectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('useractionsections')->delete();

        Useractionsection::create([
            'position' => 0,
            'content' => 'All'
        ]);
        Useractionsection::create([
            'position' => 2,
            'content' => 'Entry Condition'
        ]);
        Useractionsection::create([
            'position' => 3,
            'content' => 'Health recommendation'
        ]);
        Useractionsection::create([
            'position' => 4,
            'content' => 'Transitvisa'
        ]);
        Useractionsection::create([
            'position' => 5,
            'content' => 'Translation'
        ]);
        Useractionsection::create([
            'position' => 6,
            'content' => 'Cruise Visa'
        ]);
        Useractionsection::create([
            'position' => 7,
            'content' => 'Infosystem'
        ]);
        Useractionsection::create([
            'position' => 8,
            'content' => '3-Letter-Code'
        ]);
        Useractionsection::create([
            'position' => 9,
            'content' => 'Standard Text'
        ]);
        Useractionsection::create([
            'position' => 10,
            'content' => 'Country'
        ]);
        Useractionsection::create([
            'position' => 11,
            'content' => 'User'
        ]);
        Useractionsection::create([
            'position' => 12,
            'content' => 'Visa Condition'
        ]);
        Useractionsection::create([
            'position' => 13,
            'content' => 'Immunisation'
        ]);
        Useractionsection::create([
            'position' => 14,
            'content' => 'Inooption Child'
        ]);
        Useractionsection::create([
            'position' => 15,
            'content' => 'Inooption Pregnant'
        ]);
        Useractionsection::create([
            'position' => 16,
            'content' => 'Inoculation Specific'
        ]);
        Useractionsection::create([
            'position' => 17,
            'content' => 'Inoculation'
        ]);
        Useractionsection::create([
            'position' => 18,
            'content' => 'Visa document'
        ]);
        Useractionsection::create([
            'position' => 19,
            'content' => 'Translation'
        ]);
        Useractionsection::create([
            'position' => 20,
            'content' => 'Entry identity document'
        ]);
        Useractionsection::create([
            'position' => 21,
            'content' => 'Entry passport'
        ]);
        Useractionsection::create([
            'position' => 22,
            'content' => 'Entry additional information'
        ]);
        Useractionsection::create([
            'position' => 23,
            'content' => 'Entry minor'
        ]);
        Useractionsection::create([
            'position' => 24,
            'content' => 'Adrhead'
        ]);
        Useractionsection::create([
            'position' => 25,
            'content' => 'Adrheadkind'
        ]);
        Useractionsection::create([
            'position' => 26,
            'content' => 'Adrheadbranch'
        ]);
        Useractionsection::create([
            'position' => 27,
            'content' => 'Adrheadrole'
        ]);
        Useractionsection::create([
            'position' => 28,
            'content' => 'Contentgroup'
        ]);
        Useractionsection::create([
            'position' => 29,
            'content' => 'TUI Cruise'
        ]);
        Useractionsection::create([
            'position' => 30,
            'content' => 'Transitvisa Info'
        ]);
        Useractionsection::create([
            'position' => 31,
            'content' => 'Client'
        ]);
        Useractionsection::create([
            'position' => 32,
            'content' => 'Adrheadcooperation'
        ]);
        Useractionsection::create([
            'position' => 33,
            'content' => 'Adrheadsoftwareprovider'
        ]);
        Useractionsection::create([
            'position' => 34,
            'content' => 'Adrheadtag'
        ]);
        Useractionsection::create([
            'position' => 35,
            'content' => 'Infosystem2'
        ]);
    }
}
