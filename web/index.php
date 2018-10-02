<?php

require_once __DIR__.'/../vendor/autoload.php';

$honeypot = new \Core\HoneypotService(
    new \Core\Renderer(),
    new \Core\Logger(new Core\SyslogLogger())
);
$honeypot->parseRequest(
    new Core\Request($_SERVER)
);
