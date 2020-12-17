<?php

use Illuminate\Database\Seeder;
use App\Models\Translation;

class TranslationsSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('translations')->delete();

        Translation::create([
            'code' => 'de',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.lts',
            'text' => 'bei Langzeitaufenthalten',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'de',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.se',
            'text' => 'bei besonderer Exposition',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'de',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.ltsse',
            'text' => 'bei Langzeitaufenthalten oder besonderer Exposition',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'en',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.lts',
            'text' => 'during long-term stays',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'en',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.se',
            'text' => 'when being particularly exposed',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'en',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.ltsse',
            'text' => 'during long-term stays or when being particularly exposed',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'fr',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.lts',
            'text' => 'lors de séjours de longue durée',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'fr',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.se',
            'text' => 'lors d\'une exposition particulière',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'fr',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.ltsse',
            'text' => 'lors de séjours de longue durée ou lors d\'une exposition particulière',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'it',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.lts',
            'text' => 'durante soggiorni di lunga durata',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'it',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.se',
            'text' => 'quando si è particolarmente esposti',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'it',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.ltsse',
            'text' => 'durante soggiorni di lunga durata o quando si è particolarmente esposti',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'nl',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.lts',
            'text' => 'tijdens langdurig verblijf',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'nl',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.se',
            'text' => 'bij bijzondere blootstelling',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'nl',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.ltsse',
            'text' => 'tijdens langdurig verblijf of bij bijzondere blootstelling aan de zon',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'pl',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.lts',
            'text' => 'podczas pobytów długoterminowych',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'pl',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.se',
            'text' => 'gdy jest się szczególnie narażonym',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'es',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.lts',
            'text' => 'durante estancias de larga duración',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'es',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.se',
            'text' => 'cuando se está particularmente expuesto',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'es',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.ltsse',
            'text' => 'durante estancias de larga duración o cuando se está particularmente expuesto',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'pt',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.lts',
            'text' => 'durante estadias de longa duração',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'pt',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.se',
            'text' => 'ao ser particularmente exposto',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'pt',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.ltsse',
            'text' => 'durante estadas de longa duração ou durante uma exposição especial',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'ru',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.lts',
            'text' => 'во время длительного пребывания',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'ru',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.se',
            'text' => 'когда особенно подвергаешься воздействию',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'ru',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.ltsse',
            'text' => 'во время длительного пребывания или при особо опасном воздействии',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'de',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.ac',
            'text' => 'Zusätzliche Hinweise',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'en',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.ac',
            'text' => 'Additional information',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'fr',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.ac',
            'text' => 'Informations complémentaires',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'it',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.ac',
            'text' => 'Ulteriori informazioni',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'nl',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.ac',
            'text' => 'Aanvullende informatie',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'pl',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.ac',
            'text' => 'Informacje dodatkowe',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'es',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.ac',
            'text' => 'Información adicional',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'pt',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.ac',
            'text' => 'Informações adicionais',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'ru',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.ac',
            'text' => 'Дополнительная информация',
            'unstable' => 0,
            'locked' => 0,
        ]);
        Translation::create([
            'code' => 'pl',
            'namespace' => '*',
            'group' => 'content',
            'item' => 'hr.ltsse',
            'text' => 'podczas długotrwałych pobytów lub w przypadku szczególnego narażenia na działanie czynników zewnętrznych',
            'unstable' => 0,
            'locked' => 0,
        ]);
    }
}
