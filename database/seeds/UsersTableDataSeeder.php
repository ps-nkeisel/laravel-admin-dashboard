<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'name' => 'anakin',
            'username' => 'anakin@passolution.de',
            'email' => 'anakin@passolution.de',
            'password' => bcrypt('123456'),
            'token' => 'fdghjhgdsfghcs23gfgg4DDV3',
            'active' => 1
        ]);
        User::create([
            'name' => 'Daniel',
                'username' => 'Daniel',
                'email' => 'daniel@passolution.de',
                'password' => bcrypt('123456'),
                'token' => 'fdghjhgdsfghcs23gfgg4DDV3',
                'active' => 1
        ]);
        User::create([
                'name' => 'Elisa',
                'username' => 'Elisa',
                'email' => 'elisa@passolution.de',
                'password' => bcrypt('334wq671'),
                'token' => 'fdghjhg44dsfghcs23gfgg4DDV4',
                'active' => 1
        ]);
        User::create([
                'name' => 'Dennis',
                'username' => 'Dennis',
                'email' => 'dennis@passolution.de',
                'password' => bcrypt('337901aw'),
                'token' => 'fdghjhg22dsfghcs23gfgg4DDV6',
                'active' => 1
        ]);
        User::create([
            'name' => 'Marco',
            'username' => 'Marco',
            'email' => 'marco@passolution.de',
            'password' => bcrypt('jeh3341'),
            'token' => 'fdghjhgdsfghcsaa23gfgg4DDV6',
            'active' => 1
        ]);
        User::create([
            'name' => 'Dominik',
            'username' => 'Dominik',
            'email' => 'dominik@passolution.de',
            'password' => bcrypt('lkw2t112'),
            'token' => 'fdghjhgdsfghcs23gfdasgg4DDV6',
            'active' => 1
        ]);
        User::create([
            'name' => 'Timo',
            'username' => 'Timo',
            'email' => 'timo@passolution.de',
            'password' => bcrypt('akw3t1z2'),
            'token' => 'fdghjhgdsjkhcs23gfdasgg4DDV6',
            'active' => 1
        ]);
    }
}
