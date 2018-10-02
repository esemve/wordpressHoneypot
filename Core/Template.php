<?php


namespace Core;

class Template
{
    /**
     * @var string
     */
    private $file;
    /**
     * @var string
     */
    private $header;

    public function __construct(string $file, string $header)
    {

        $this->file = $file;
        $this->header = $header;
    }

    public function getHeader(): string
    {
        return $this->header;
    }

    public function getFile(): string
    {
        return $this->file;
    }

}