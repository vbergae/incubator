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


use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

$console = new Application('Incubator', '0.0.1');
$console->getDefinition()->addOption(new InputOption('--env', '-e', InputOption::VALUE_REQUIRED, 'The Environment name.', 'dev'));
$console->setDispatcher($app['dispatcher']);

$console->setHelperSet(new Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($app["db"]),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($app["orm.em"])
)));

$console->addCommands(array(

  new \Doctrine\ORM\Tools\Console\Command\ClearCache\MetadataCommand,
  new \Doctrine\ORM\Tools\Console\Command\ClearCache\QueryCommand,
  new \Doctrine\ORM\Tools\Console\Command\ClearCache\ResultCommand,
  new \Doctrine\ORM\Tools\Console\Command\SchemaTool\CreateCommand,
  new \Doctrine\ORM\Tools\Console\Command\SchemaTool\DropCommand,
  new \Doctrine\ORM\Tools\Console\Command\SchemaTool\UpdateCommand,
  new \Doctrine\ORM\Tools\Console\Command\ConvertDoctrine1SchemaCommand,
  new \Doctrine\ORM\Tools\Console\Command\ConvertMappingCommand,
  new \Doctrine\ORM\Tools\Console\Command\EnsureProductionSettingsCommand,
  new \Doctrine\ORM\Tools\Console\Command\GenerateEntitiesCommand,
  new \Doctrine\ORM\Tools\Console\Command\GenerateProxiesCommand,
  new \Doctrine\ORM\Tools\Console\Command\GenerateRepositoriesCommand,
  new \Doctrine\ORM\Tools\Console\Command\InfoCommand,
  new \Doctrine\ORM\Tools\Console\Command\RunDqlCommand,
  new \Doctrine\ORM\Tools\Console\Command\ValidateSchemaCommand,
  new \Doctrine\DBAL\Tools\Console\Command\ImportCommand,
  new \Doctrine\DBAL\Tools\Console\Command\ReservedWordsCommand,
  new \Doctrine\DBAL\Tools\Console\Command\RunSqlCommand

));


return $console;
