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
        if ($request->getIp()==='127.0.0.1') {
            die('Hit, but not logged because you watch from localhost!');
        }

        $this->logger->log($request->getIp());
        die('You are banned!');
    }

}