<?php

namespace Pokey;

define('POKEY_SEARCH_URL', 'http://yellow5.com/pokey/search/?kw=');

class API {

    public static function search ($term) {
        $dom = new \DOMDocument();
        $dom->loadHTMLFile(POKEY_SEARCH_URL . urlencode($term));

        $strips = $dom->getElementsByTagName('h3');
        $links = $dom->getElementsByTagName('a');
        $images = $dom->getElementsByTagName('img');
        $texts = $dom->getElementsByTagName('i');

        $results = [];
        for ($n = 0, $num = count($strips); $n < $num; $n++) {
            $results[$n] = array(
                'title' => $strips->item($n)->nodeValue,
                'link' => $links->item($n)->getAttribute('href'),
                'image' => $images->item($n)->getAttribute('src'),
                'text' => $texts->item($n)->nodeValue
            );
        }

        return $results;
    }

}
