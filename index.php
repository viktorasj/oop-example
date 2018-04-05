<?php

require __DIR__ . '/vendor/autoload.php';


$controller = new \Weather\Controller\StartPage();
$weather = $controller->getTodayWeather();

echo '<p>Weather</p>';

foreach ($weather as $item) {
    echo sprintf(
        '<ul>
                <li>Day <b>%s</b></li>
                <li>Day temp: <b>%d</b></li>
                <li>Night temp: <b>%d</b></li>',
        $item->getDate()->format('Y-m-d'),
        $item->getDayTemp(),
        $item->getNightTemp()
    );
}
