<?php

namespace Weather\Model;

class NullJsonWeather extends Weather
{
    public function __construct()
    {
        $this->setDay('sat');
        $this->setLow(37);
        $this->setHigh(99);
        $this->setSky("Scattered Showers");
        $this->setDate(new \DateTime('1970-01-01'));
    }
}
