<?php

namespace Core;

class Configuration
{
    /**
     * @var string
     */
    protected $logger;

    /**
     * @var int
     */
    protected $maxFileSize;

    public function __construct()
    {
        $config = require_once __DIR__.'/../config.php';

        $this->logger = $config['logger'];
        $this->maxFileSize = $config['max_log_size'];

    }

    public function getLogger(): string
    {
        return $this->logger;
    }

    public function getMaxFileSize(): int
    {
        return $this->maxFileSize;
    }

}