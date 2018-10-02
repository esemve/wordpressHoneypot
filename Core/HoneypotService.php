<?php

namespace Core;

class HoneypotService
{
    /**
     * @var Renderer
     */
    protected $renderer;
    /**
     * @var Logger
     */
    private $logger;

    public function __construct(Renderer $renderer, Logger $logger)
    {
        $this->renderer = $renderer;
        $this->logger = $logger;
    }

    public function parseRequest(Request $request)
    {
        if ((!$request->isGet()) || (!$this->renderer->hasTemplate($request))) {
            $this->ban($request);
        }

        $this->renderer->render($request);
    }

    protected function ban(Request $request) {
        $this->logger->log($request->getIp());
        die('Banned');
    }

}