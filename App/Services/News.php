<?php

namespace App\Services;

use Core\Service;

class News implements Service
{
    public function getNews($maxCount)
    {
        $resultList = [];

        $context  = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
        $url = 'https://news.google.com/news/rss/?ned=de&gl=DE&hl=de';

        $xml = file_get_contents($url, false, $context);
        $xml = simplexml_load_string($xml);

        $count = 1;
        foreach ($xml->channel->item as $item) {
            if($count == $maxCount)
                break;

            $resultList[] = [
                'title' => $item->title,
                'content' => $item->description
            ];

            $count++;
        }

        return $resultList;
    }
}