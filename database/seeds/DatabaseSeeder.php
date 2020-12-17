<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Users
        /*
        $user = User::firstOrCreate(
            ['email' => 'darthvader@deathstar.ds'],
            [
                'name' => 'anakin',
                'username' => 'anakin-ds',
                'password' => Hash::make('4nak1n'),
                'token' => 'djgROr57aadW112KlQtfG3',
                'email_verified_at' => now()
            ]
        );
        */

        $this->call(UsersTableDataSeeder::class);
        $this->call(LanguagesSeeder::class);
        $this->call(InfosystemsSeeder::class);
        $this->call(UseractionsectionsSeeder::class);
        $this->call(UseractiontypesSeeder::class);
        $this->call(UseractivitiesSeeder::class);
        $this->call(ContentcategoriesSeeder::class);
        $this->call(ImmunisationsSeeder::class);
        $this->call(InocontentsSeeder::class);
        $this->call(InoculationsSeeder::class);
        $this->call(InooptionchildrenSeeder::class);
        $this->call(InooptionpregnantsSeeder::class);
        $this->call(InoculationspecificsSeeder::class);
        $this->call(LanguageablesSeeder::class);
        $this->call(InoimmumatchsSeeder::class);
        $this->call(InooptpregmatchsSeeder::class);
        $this->call(InooptchildmatchsSeeder::class);
        $this->call(InooptspecmatchsSeeder::class);
        $this->call(ContentsSeeder::class);
        $this->call(NationalitiesSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(TranslationsSeeder::class);
        $this->call(VisadocumentsSeeder::class);
        $this->call(YellowfeversSeeder::class);

    }
}
