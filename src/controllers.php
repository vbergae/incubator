<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//Request::setTrustedProxies(array('127.0.0.1'));

$app->get('/', function() use ($app) {
   return $app['twig']->render('index.html.twig'); 
});

$app->get('/dashboard', function() use ($app) {
    $starred = array();
    for ($i = 0; $i < 10; ++$i) {
        $starred[] = 'My Starred Project '.($i + 1);
    }

    $user = array();
    for ($i = 0; $i < 10; ++$i) {
        $user[] = 'My Project '.($i + 1);
    }    
    
    return $app['twig']->render('dashboard.html.twig', array (
       'starred_projects'   => $starred,
        'user_projects'     => $user
    ));
});

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html.twig, or 40x.html.twig, or 4xx.html.twig, or error.html.twig
    $templates = array(
        'errors/'.$code.'.html.twig',
        'errors/'.substr($code, 0, 2).'x.html.twig',
        'errors/'.substr($code, 0, 1).'xx.html.twig',
        'errors/default.html.twig',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});
