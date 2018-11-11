<?php

namespace Weather;

use Weather\Api\DataProvider;
use Weather\Api\DbRepository;
use Weather\Model\Weather;

class Manager
{
    /**
     * @var DataProvider
     */
    private $transporter;

    public function getTodayInfo($src): Weather
    {
        return $this->getTransporter($src)->selectByDate(new \DateTime());
    }

    public function getWeekInfo($src): array
    {
        return $this->getTransporter($src)->selectByRange(new \DateTime(), new \DateTime('+7 days'));
    }

    private function getTransporter($src)
    {
        if (null === $this->transporter) {
            $this->transporter = new DbRepository($src);
        }

        return $this->transporter;
    }
}


