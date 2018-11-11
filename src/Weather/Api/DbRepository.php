<?php

namespace Weather\Api;

use Weather\Model\NullWeather;
use Weather\Model\NullJsonWeather;
use Weather\Model\Weather;


class DbRepository implements DataProvider
{
    /**
     * @param \DateTime $date
     * @return Weather
     */
    protected $source;
    protected $data;

    public function __construct($src)
    {
        $this->source = $src;
    }

    public function selectByDate(\DateTime $date): Weather
    {
          $items = $this->selectAll();
          switch($this->source) {
              case 'json-weather':
                  $result = new NullJsonWeather();
                  break;
              default:
                  $result = new NullWeather();
                  break;
          }
        foreach ($items as $item) {
            if ($item->getDate()->format('Y-m-d') === $date->format('Y-m-d')) {
                $result = $item;
            }
        }
        return $result;
    }

    public function selectByRange(\DateTime $from, \DateTime $to): array
    {
        $items = $this->selectAll();
        $result = [];

        foreach ($items as $item) {
            if ($item->getDate() >= $from && $item->getDate() <= $to) {
                $result[] = $item;
            }
        }
        return $result;
    }

    /**
     * @return Weather[]
     */
    private function selectAll(): array
    {
        switch($this->source){
            case 'google':
                if(empty($this->data)) {
                    $googleWeatherApiObj = new GoogleApi();
                    $this->data = $googleWeatherApiObj->getWeatherData();
                    return $this->data;
                }
                else {
                    return $this->data;
                }
                break;
            case 'json-weather':
                $result = [];
                $data = json_decode(
                    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'Db' . DIRECTORY_SEPARATOR . 'Weather.json'),
                    true
                );
//                    print_r($data);
                foreach ($data as $item) {
                    $record = new Weather();
                    $record->setDate(new \DateTime (date('Y-m-d', strtotime($item['date']))));
                    $record->setDay($item['day']);
                    $record->setLow($item['low']);
                    $record->setHigh($item['high']);
                    $record->setSky($item['text']);
                    $record->setDbSource($this->source);
                    $result[] = $record;
                }
                return $result;
                break;
            case 'json-data':
                $result = [];
                $data = json_decode(
                    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'Db' . DIRECTORY_SEPARATOR . 'Data.json'),
                    true
                );
                foreach ($data as $item) {
                    $record = new Weather();
                    $record->setDate(new \DateTime($item['date']));
                    $record->setDayTemp($item['dayTemp']);
                    $record->setNightTemp($item['nightTemp']);
                    $record->setSky($item['sky']);
                    $result[] = $record;
                }
                return $result;
        }

    }
    }
