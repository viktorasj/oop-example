<?php

namespace Weather\Controller;

use Weather\Manager;
use Weather\Model\NullWeather;

class StartPage
{
    public function getTodayWeather($source): array
    {
        try {
            $service = new Manager;
            $weather = $service->getTodayInfo($source);
        } catch (\Exception $exp) {
            $weather = new NullWeather();
        }

        switch($source) {
            case 'json-weather':
                return ['template' => 'today-weather-json.twig', 'context' => ['weather' => $weather]];
                break;
            default:
                return ['template' => 'today-weather.twig', 'context' => ['weather' => $weather]];
                break;

        }

    }

    public function getWeekWeather($source): array
    {
            try {
                $service = new Manager;
                $weathers = $service->getWeekInfo($source);
            }
            catch (\Exception $exp) {
            $weathers = [];
            }
            switch($source) {
                case 'json-weather':
                    return ['template' => 'range-weather-json.twig', 'context' => ['weathers' => $weathers]];
                    break;
                default:
                    return ['template' => 'range-weather.twig', 'context' => ['weathers' => $weathers]];
                    break;

        }

    }
}
