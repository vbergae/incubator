<?php

//   Copyright 2014 Víctor Berga <vbergae@gmail.com>
//
//   Licensed under the Apache License, Version 2.0 (the "License");
//   you may not use this file except in compliance with the License.
//   You may obtain a copy of the License at
//
//       http://www.apache.org/licenses/LICENSE-2.0
//
//   Unless required by applicable law or agreed to in writing, software
//   distributed under the License is distributed on an "AS IS" BASIS,
//   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
//   See the License for the specific language governing permissions and
//   limitations under the License.


// configure your app for the production environment

$app['twig.path'] = array(__DIR__.'/../templates');
$app['twig.options'] = array('cache' => __DIR__.'/../var/cache/twig');

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options'    => array(
    'driver'        => 'pdo_mysql',
    'host'          => 'localhost',
    'dbname'        => 'name',
    'user'          => 'root',
    'password'      => '',
    'charset'       => 'utf8',
    'driverOptions' => array(1002 => 'SET NAMES utf8',),
  ),
));

$app->register(new Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider, array(
    "orm.em.options" => array(
         "mappings" => array(
            array(
               "type"      => "yml",
               "namespace" => "Entity",
               "path"      => realpath(__DIR__."/../config/doctrine"),
              ),
            ),
         ),
));