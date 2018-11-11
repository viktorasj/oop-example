<?php

namespace Weather\Model;

class Weather
{
    private $map = [
        1 => 'cloud',
        2 => 'cloud-rain',
        3 => 'sun',
        "Mostly Cloudy" => 'cloud',
        "Cloudy" => 'cloud',
        "Partly Cloudy" => 'cloud',
        "Breezy" => 'sun',
        "Scattered Showers" => 'cloud-rain'
    ];

    /**
     * @var integer
     */
    protected $dayTemp;

    /**
     * @var integer
     */
    protected $nightTemp;

    /**
     * @var int
     */
    protected $sky;

    /**
     * @var \DateTime
     */
    protected $date;

    /**
     * @return int
     */
    protected $day;
    protected $high;
    protected $low;
    protected $dbSource;

    public function getDayTemp(): int
    {
        return $this->dayTemp;
    }

    /**
     * @param int $dayTemp
     */
    public function setDayTemp(int $dayTemp): void
    {
        $this->dayTemp = $dayTemp;
    }

    /**
     * @return int
     */
    public function getNightTemp(): int
    {
        return $this->nightTemp;
    }

    /**
     * @param int $nightTemp
     */
    public function setNightTemp(int $nightTemp): void
    {
        $this->nightTemp = $nightTemp;
    }

    /**
     * @return int
     */
    public function getSky()
    {
        return $this->sky;
    }


    public function setSky($sky): void
    {
        $this->sky = $sky;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    public function getSkySymbol()
    {
        return $this->map[$this->sky];
    }

    public function setDay(string $day): void
    {
        $this->day = $day;
    }

    public function getDay()
    {
        return $this->day;
    }

    public function setLow(int $low): void
    {
        $this->low = $low;
    }

    public function getLow()
    {
        return $this->low;
    }

    public function setHigh(int $high): void
    {
        $this->high = $high;
    }

    public function getHigh()
//        šitas labai geras metodas
    {
        return $this->high;
    }

    public function setDbSource(string $db): void
    {
        $this->dbSource = $db;
    }
}
