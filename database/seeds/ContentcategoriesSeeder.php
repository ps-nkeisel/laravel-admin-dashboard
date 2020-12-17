<?php

use Illuminate\Database\Seeder;
use App\Models\Contentcategory;

class ContentcategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contentcategories')->delete();

        Contentcategory::create([
            'position' => 1,
            'content' => 'Entry'
        ]);
        Contentcategory::create([
            'position' => 2,
            'content' => 'Visa'
        ]);
        Contentcategory::create([
            'position' => 3,
            'content' => 'Transitvisa'
        ]);
        Contentcategory::create([
            'position' => 4,
            'content' => 'Health recommendations'
        ]);
        Contentcategory::create([
            'position' => 5,
            'content' => 'Visa places'
        ]);
        Contentcategory::create([
            'position' => 6,
            'content' => 'Diverses'
        ]);
    }
}
