<?php

declare(strict_types=1);

namespace App\Presentation;

use Nette\Bootstrap\Configurator;

class Bootstrap
{
	public static function boot(): Configurator
	{
		$configurator = new Configurator();
		$appDir = dirname(__DIR__, 2);


		$configurator->setDebugMode(true); // enable for your remote IP
		$configurator->enableTracy($appDir . '/log');
		$configurator->setTempDirectory($appDir . '/temp');
		$configurator->addConfig($appDir . '/app/Infrastructure/config/config.neon');

		return $configurator;
	}
}
