<?php

use App\Models\Translation;

if (!function_exists('getTranslation')) {
    function getTranslation($item, $lang) {
        $trans = Translation::select('text')->where('code', $lang)->where('item', $item)->first();
        return ($trans && $trans->text) ? $trans->text : $item;
    }
}

if (!function_exists('getTranslationStatusArray')) {
    function getTranslationStatusArray() {
        return [
            'must be translated professionally',
            'sent to agency for translation',
            'professionally translated',
            'translated with deepl',
            'manually translated',
            'source language - do not translate',
        ];
    }
}

if (!function_exists('translationStatusNum2Text')) {
    function translationStatusNum2Text($num) {
        if (1 <= $num && $num <= 5) {
            $translation_status = getTranslationStatusArray();
            return $translation_status[$num - 1];
        } else {
            return '';
        }
    }
}
