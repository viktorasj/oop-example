<?php

namespace Weather\Controller;

use Weather\Api\DbRepository;
use Weather\Api\GoogleApi;
use Weather\Model\NullWeather;
use Weather\Model\Weather;

class StartPage
{
    /**
     * @return Weather[]
     */
    public function getTodayWeather(): array
    {
        try {
            $fromGoogle = new GoogleApi();
            $weather = $fromGoogle->getToday();
        } catch (\Exception $exp) {
            $weather = new NullWeather();
        }

        return [$weather];
    }
}
