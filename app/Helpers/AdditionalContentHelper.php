<?php

use App\Models\Content;

if (!function_exists('formatAcToWeb')) {
    function formatAcToWeb($contentadditionals = array(), $language, $brBeforeH1=0, $checkTxt="", $hl=true, $headercode="") {
        $returnData = "";
        if ($checkTxt != "") {
            $returnData .= '<br>' . $checkTxt;
        }
        if(count($contentadditionals) > 0) {
            if ($brBeforeH1 == 1) {
                $returnData .= '<br>';
            }
            if ($headercode != "") {
                $returnData .= '<b>'.getTranslation($headercode, $language->code).'</b><br>';
            }
            $count = 0;
            foreach ($contentadditionals as $contentadditional) {
                $languageContent = $contentadditional->languages->find($language->id);
                if ($languageContent) {
                    if ($hl == true) {
                        $headline = $contentadditional->getHeadline($language);
                        if ($headline != "") {
                            $returnData .= '<br><b>'.$headline.'</b><br>';
                            $returnData .= $languageContent->pivot->content;
                        } else {
                            $returnData .= '<br>'.$languageContent->pivot->content;
                        }
                    } else {
                        if ($count > 0) {
                            $returnData .= '<br>';
                        }
                        $returnData .= $languageContent->pivot->content;
                    }
                }
                $count++;
            }
        }
        return $returnData;
    }
}

if (!function_exists('extractAcToArray')) {
    function extractAcToArray($contentadditionals = array(), $language) {
        $arrContents = [];
        if (count($contentadditionals) > 0) {
            foreach ($contentadditionals as $contentadditional) {
                $languageContent = $contentadditional->languages->find($language->id);
                if ($languageContent) {
                    array_push($arrContents, [
                        'headline' => $contentadditional->getHeadline($language),
                        'content' => $languageContent->pivot->content
                    ]);
                }
            }
        }
        return $arrContents;
    }
}
