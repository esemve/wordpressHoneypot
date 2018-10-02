<?php


namespace Core;

interface LoggerInterface
{
    public function log(string $ip): void;
}