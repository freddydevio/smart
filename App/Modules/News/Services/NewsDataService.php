<?php

namespace App\Modules\News\Services;

use Core\Services\Service;

class NewsDataService extends Service
{
    public function getData($listMax = 5)
    {
        $resultList = [];

        $context  = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
        $url = 'https://news.google.com/news/rss/?ned=de&gl=DE&hl=de';

        $xml = file_get_contents($url, false, $context);
        $xml = simplexml_load_string($xml);

        $count = 1;
        foreach ($xml->channel->item as $item) {
            if($count == $listMax)
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