<?php

namespace Weather\Api;

use Weather\Model\NullWeather;
use Weather\Model\Weather;

class DbRepository
{
    /**
     * @return Weather
     */
    public function getToday()
    {
        return $this->selectByDate(new \DateTime());
    }

    /**
     * @param \DateTime $date
     * @return Weather
     */
    private function selectByDate(\DateTime $date)
    {
        $items = $this->selectAll();
        $result = new NullWeather();

        foreach ($items as $item) {
            if ($item->getDate()->format('Y-m-d') === $date->format('Y-m-d')) {
                $result = $item;
            }
        }

        return $result;
    }

    /**
     * @return Weather[]
     */
    private function selectAll()
    {
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
