<?php


namespace Core;

class Logger implements LoggerInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function log(string $ip): void
    {
        $this->logger->log($ip);
    }

}