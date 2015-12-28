<?php

require __DIR__ . '/../vendor/autoload.php';

// Instantiate the app
$settings = require __DIR__ . '/../app/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/../app/dependencies.php';

$container = $app->getContainer();
$pdo = $container->get('pdo');

$schema = file_get_contents(__DIR__.'/schema.sql');
$pdo->exec($schema);

// Fixtures
$userManager = $container->get('userManager');
$user = $userManager->create('test', 'jlagneau@student.42.fr', 'test');

$user->setActive(1);

$userManager->add($user);
