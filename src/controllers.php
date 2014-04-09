<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//Request::setTrustedProxies(array('127.0.0.1'));

$app->get('/', function() use ($app) {
   return $app['twig']->render('index.html'); 
});

$app->get('/dashboard', function() use ($app) {
    $starred = array();
    for ($i = 0; $i < 10; ++$i) {
        $starred[] = 'My Starred Project '.($i + 1);
    }
    
    return $app['twig']->render('dashboard.html', array (
       'starred_projects' => $starred 
    ));
});

$app->get('/hello/{name}', function ($name) use ($app) {
    return $app['twig']->render('hello.html', array(
        'name' => $app->escape($name))
    );
});

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/'.$code.'.html',
        'errors/'.substr($code, 0, 2).'x.html',
        'errors/'.substr($code, 0, 1).'xx.html',
        'errors/default.html',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});
