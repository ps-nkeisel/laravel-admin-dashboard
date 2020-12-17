<?php

use Illuminate\Database\Seeder;
use App\Models\Visadocument;

class VisadocumentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('visadocuments')->delete();

        $visaContents = [
            'Visumantrag',
            'Ausreichend gültiges Reisedokument',
            'Passfoto(s)',
            'Weiter- oder Rückflugticket',
            'Einladung einer privaten Stelle',
            'Einladung einer öffentlichen Stelle',
            'Nachweis über ausreichend finanzielle Mittel',
            'Nachweis einer Unterkunft',
            'Aufenthaltstitel',
            'Meldebescheinigung',
        ];

        for ($i = 0; $i < sizeof($visaContents); $i ++) {
            Visadocument::create([
                'position' => $i+1,
                'content' => $visaContents[$i],
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'updated_ip' => '127.0.0.1',
                'updated_user' => 1,
            ]);
        }
    }
}
