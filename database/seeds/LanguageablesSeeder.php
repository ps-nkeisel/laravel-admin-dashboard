<?php

use Illuminate\Database\Seeder;

class LanguageablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languageables')->delete();
        DB::table('languageables')->insert(array (
            array(
                'languageable_id' => 10,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 1,
                'content' => 'Impfungen gemäß aktuellem Impfkalender des Robert-Koch-Instituts',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 11,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 1,
                'content' => 'Hepatitis A',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 12,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 1,
                'content' => 'Hepatitis B',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 13,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 1,
                'content' => 'Hepatitis C',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 14,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 1,
                'content' => 'Typhus',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 15,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 1,
                'content' => 'Cholera',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 16,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 1,
                'content' => 'Meningokokken-Krankheit (ACWY)',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 17,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 1,
                'content' => 'Tollwut',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 18,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 1,
                'content' => 'Vogelgrippe',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 10,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 2,
                'content' => 'Vaccinations according to the current vaccination calendar of the Robert Koch Institute',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 11,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 2,
                'content' => 'Hepatitis A',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 12,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 2,
                'content' => 'Hepatitis B',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 13,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 2,
                'content' => 'Hepatitis C',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 14,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 2,
                'content' => 'Typhoid',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 15,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 2,
                'content' => 'Cholera',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 16,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 2,
                'content' => 'Meningococcal disease (ACWY)',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 17,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 2,
                'content' => 'Rabies',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 18,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 2,
                'content' => 'Bird flu',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 10,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 3,
                'content' => 'Vaccinations selon le calendrier de vaccination actuel de l\'Institut Robert Koch',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 11,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 3,
                'content' => 'Hépatite A',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 12,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 3,
                'content' => 'Hépatite B',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 13,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 3,
                'content' => 'Hépatite C',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 14,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 3,
                'content' => 'Typhoïde',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 15,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 3,
                'content' => 'Choléra',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 16,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 3,
                'content' => 'Maladie à méningocoques (ACWY)',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 17,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 3,
                'content' => 'Rage',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 18,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 4,
                'content' => 'Grippe aviaire',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 10,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 4,
                'content' => 'Vaccinazioni secondo il calendario attuale delle vaccinazioni dell\'Istituto Robert Koch',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 11,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 4,
                'content' => 'Epatite A',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 12,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 4,
                'content' => 'Epatite B',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 13,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 4,
                'content' => 'Epatite C',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 14,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 4,
                'content' => 'Tifoide',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 15,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 4,
                'content' => 'Colera',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 16,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 4,
                'content' => 'Malattia del meningococco (ACWY)',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 17,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 4,
                'content' => 'Rabbia',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 18,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 5,
                'content' => 'Influenza aviaria',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 10,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 5,
                'content' => 'Vaccinaties volgens de huidige vaccinatiekalender van het Robert Koch-Instituut',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 11,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 5,
                'content' => 'Hepatitis A',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 12,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 5,
                'content' => 'Hepatitis B',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 13,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 5,
                'content' => 'Hepatitis C',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 14,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 5,
                'content' => 'Tyfus',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 15,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 5,
                'content' => 'Cholera',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 16,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 5,
                'content' => 'Meningokokkenziekte (ACWY)',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 17,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 5,
                'content' => 'Hondsdolheid',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 18,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 5,
                'content' => 'Vogelgriep',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 10,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 6,
                'content' => 'Szczepienia zgodnie z aktualnym kalendarzem szczepień Instytutu Roberta Kocha',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 11,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 6,
                'content' => 'Zapalenie wątroby A',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 12,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 6,
                'content' => 'Zapalenie wątroby B',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 13,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 6,
                'content' => 'Zapalenie wątroby C',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 14,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 6,
                'content' => 'Tyfus brzuszny',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 15,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 6,
                'content' => 'Cholera',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 16,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 6,
                'content' => 'Choroba meningokokowa (ACWY)',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 17,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 6,
                'content' => 'Wścieklizna',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 18,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 6,
                'content' => 'Ptasia grypa',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 10,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 7,
                'content' => 'Vacunas según el calendario de vacunación actual del Instituto Robert Koch',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 11,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 7,
                'content' => 'Hepatitis A',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 12,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 7,
                'content' => 'Hepatitis B',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 13,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 7,
                'content' => 'Hepatitis C',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 14,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 7,
                'content' => 'Tifoidea',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 15,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 7,
                'content' => 'Cólera',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 16,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 7,
                'content' => 'Enfermedad meningocócica (ACWY)',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 17,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 7,
                'content' => 'Rabia',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 18,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 7,
                'content' => 'Gripe aviar',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 10,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 8,
                'content' => 'Vacinação de acordo com o calendário atual de vacinação do Instituto Robert Koch',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 11,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 8,
                'content' => 'Hepatite A',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 12,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 8,
                'content' => 'Hepatite B',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 13,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 8,
                'content' => 'Hepatite C',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 14,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 8,
                'content' => 'Febre tifóide',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 15,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 8,
                'content' => 'Cólera',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 16,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 8,
                'content' => 'Doença meningocócica (ACWY)',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 17,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 8,
                'content' => 'Raiva',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 18,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 8,
                'content' => 'Gripe aviária',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),

            array(
                'languageable_id' => 10,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 9,
                'content' => 'Вакцинация в соответствии с текущим календарем прививок Института Роберта Коча',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 11,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 9,
                'content' => 'гепатит A',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 12,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 9,
                'content' => 'гепатит B',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 13,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 9,
                'content' => 'гепатит C',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 14,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 9,
                'content' => 'брюшной тиф',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 15,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 9,
                'content' => 'холера',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 16,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 9,
                'content' => 'Менингококковая болезнь (ACWY)',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 17,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 9,
                'content' => 'бешенство',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 18,
                'languageable_type' => 'App\Models\Immunisation',
                'language_id' => 9,
                'content' => 'птичий грипп',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 1,
                'languageable_type' => 'App\Models\Inooptionpregnant',
                'language_id' => 1,
                'content' => 'Zika-Virus',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 2,
                'languageable_type' => 'App\Models\Inooptionpregnant',
                'language_id' => 1,
                'content' => 'Chikungunya-Fieber',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 1,
                'languageable_type' => 'App\Models\Inooptionpregnant',
                'language_id' => 2,
                'content' => 'Zika virus',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 2,
                'languageable_type' => 'App\Models\Inooptionpregnant',
                'language_id' => 2,
                'content' => 'Chikungunya fever',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 1,
                'languageable_type' => 'App\Models\Inooptionchild',
                'language_id' => 1,
                'content' => 'Dengue-Fieber',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 2,
                'languageable_type' => 'App\Models\Inooptionchild',
                'language_id' => 1,
                'content' => 'HFMK',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 1,
                'languageable_type' => 'App\Models\Inooptionchild',
                'language_id' => 2,
                'content' => 'Dengue fever',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 2,
                'languageable_type' => 'App\Models\Inooptionchild',
                'language_id' => 2,
                'content' => 'HFMD',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 1,
                'languageable_type' => 'App\Models\Inoculationspecific',
                'language_id' => 1,
                'content' => 'Gelbfieber',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 1,
                'languageable_type' => 'App\Models\Inoculationspecific',
                'language_id' => 2,
                'content' => 'Yellowfever',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 2,
                'languageable_type' => 'App\Models\Inoculationspecific',
                'language_id' => 1,
                'content' => 'Malaria',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 2,
                'languageable_type' => 'App\Models\Inoculationspecific',
                'language_id' => 2,
                'content' => 'Malaria',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 3,
                'languageable_type' => 'App\Models\Inoculationspecific',
                'language_id' => 1,
                'content' => 'Masern',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 3,
                'languageable_type' => 'App\Models\Inoculationspecific',
                'language_id' => 2,
                'content' => 'Measles',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 4,
                'languageable_type' => 'App\Models\Inoculationspecific',
                'language_id' => 1,
                'content' => 'HIV',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
            array(
                'languageable_id' => 4,
                'languageable_type' => 'App\Models\Inoculationspecific',
                'language_id' => 2,
                'content' => 'HIV',
                'created_ip' => '127.0.0.1',
                'created_user' => 1,
                'created_at' => '2019-04-01 22:52:01'
            ),
        ));
    }
}
