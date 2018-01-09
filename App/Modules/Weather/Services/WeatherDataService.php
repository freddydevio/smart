<?php

namespace App\Modules\Weather\Services;

use Core\Services\ConfigService;
use Core\Services\Service;

class WeatherDataService extends Service
{
    public function getWeatherData($forecastsMax = 3)
    {
        /** @var ConfigService $configService */
        $configService = $this->serviceContainer->getService('ConfigService');

        $configSettingCity = $configService->getModuleConfig('weather_city');

        $BASE_URL = "http://query.yahooapis.com/v1/public/yql";
        $yql_query = 'select * from weather.forecast where woeid in (select woeid from geo.places(1) where text="'. $configSettingCity .'") and u="c"';
        $yql_query_url = $BASE_URL . "?q=" . urlencode($yql_query) . "&format=json";
        $session = curl_init($yql_query_url);
        curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
        $result = json_decode(curl_exec($session));

        $data = $this->objectToArray($result->query->results->channel);

        $forecasts = [];
        $forecastsCount = 0;
        foreach ($data['item']['forecast'] as $forecast) {
            if ($forecastsCount == $forecastsMax) {
                break;
            }
            $forecasts[] = $forecast;
            $forecastsCount++;
        }

        $result = [
            'units' => $data['units'],
            'location' => $data['location'],
            'wind' => $data['wind'],
            'current' => $data['item']['condition'],
            'forecasts' => $forecasts
        ];

        return $result;
    }

    public function objectToArray($obj) {
        if(is_object($obj)) $obj = (array) $obj;
        if(is_array($obj)) {
            $new = array();
            foreach($obj as $key => $val) {
                $new[$key] = $this->objectToArray($val);
            }
        }
        else $new = $obj;
        return $new;
    }
}