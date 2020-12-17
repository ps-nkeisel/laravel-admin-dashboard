<?php

use App\Models\Content;

if (!function_exists('getContent')) {
    function getContent($code1, $field, $lang, $default = null) {
        $content = Content::where('active', 1)->where('lang', $lang)->where('code1', $code1)->orderBy('version', 'desc')->first();
        $placeholder = (getenv('SHOWPLACEHOLDER') && getenv('SHOWPLACEHOLDER') == 1) ? $code1 : '';
        return strip_tags(($content && $content->$field) ? $content->$field : ($default ?? $placeholder));
    }
}

if (!function_exists('formatContent')) {
    function formatContent($data)
    {
        $breaks = array("<br />","<br>","<br/>");
        $html = array("<p>","<b>","</b>");

        $data = str_ireplace($breaks, "\r\n", $data);
        $data = str_ireplace($html, "", $data);
        $data = str_replace("</p>", "\r\n", $data);
        $data = html_entity_decode($data);

        return $data;
    }
}
