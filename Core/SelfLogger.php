<?php

namespace Core;

class SelfLogger implements LoggerInterface
{
    /**
     * @var int
     */
    private $maxFileSize;

    public function __construct(int $maxFileSize)
    {
        $this->maxFileSize = $maxFileSize;
    }

    public function log(string $ip): void
    {
        $this->rotate();

        file_put_contents($this->getFileName('hit.log'), $this->createLine($ip),FILE_APPEND | LOCK_EX);
    }

    protected function createLine(string $ip): string
    {
        return sprintf('%s %s [WPHoneypot]: WP Honeypot hit from %s'.PHP_EOL,
            (int) date('j')>10 ? date('M j H:i:s') : date('M  j H:i:s'),
            gethostname(),
            $ip
        );
    }

    protected function rotate(): void
    {
        $fileName = $this->getFileName('hit.log');
        if (file_exists($fileName)) {
            if (filesize($fileName) > $this->maxFileSize) {
                rename($fileName, $this->getFileName('hit_' . date('YmdHis') . '.log'));
            }
        }
    }

    protected function getFileName(string $fileName): string
    {
        return __DIR__.'/../logs/'.$fileName;
    }
}