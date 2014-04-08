<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app["debug"] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));

$app->get('/', function() use ($app) {
   return $app['twig']->render('index.html.twig'); 
});

$app->get('/hello/{name}', function ($name) use ($app) {
    return $app['twig']->render('hello.html.twig', array(
        'name' => $app->escape($name))
    );
});

$app->run();
