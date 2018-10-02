<?php

require_once __DIR__.'/../vendor/autoload.php';

$config = new Core\Configuration();
$loggerClass = $config->getLogger();

if ($loggerClass===Core\SelfLogger::class) {
    $logger = new Core\Logger(new $loggerClass($config->getMaxFileSize()));
} else {
    $logger = new Core\Logger(new $loggerClass);
}

$honeypot = new Core\HoneypotService(
    new Core\Renderer(),
    $logger
);

$honeypot->parseRequest(
    new Core\Request($_SERVER)
);
