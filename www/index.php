<?php

declare(strict_types=1);

use App\Presentation\Bootstrap;

require __DIR__ . '/../vendor/autoload.php';

$configurator = Bootstrap::boot();
$container = $configurator->createContainer();
$application = $container->getByType(Nette\Application\Application::class);
$application->run();
