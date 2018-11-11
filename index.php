<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$loader = new Twig_Loader_Filesystem('View', __DIR__ . '/src/Weather');
$twig = new Twig_Environment($loader, ['cache' => __DIR__ . '/cache', 'debug' => true]);

$controller = new Weather\Controller\StartPage();
switch ($request->getRequestUri()) {

    case '/google':
        $renderInfo = $controller->getTodayWeather('google');
        break;
    case '/google-week':
        $renderInfo = $controller->getWeekWeather('google');
        break;
    case '/json-weather':
        $renderInfo = $controller->getTodayWeather('json-weather');
        break;
    case '/json-weather-week':
        $renderInfo = $controller->getWeekWeather('json-weather');
        break;
    default:
        $renderInfo = $controller->getTodayWeather('json-data');
    break;
}
$renderInfo['context']['resources_dir'] = 'src/Weather/Resources';

$content = $twig->render($renderInfo['template'], $renderInfo['context']);

$response = new Response(
    $content,
    Response::HTTP_OK,
    array('content-type' => 'text/html')
);
//$response->prepare($request);
$response->send();
