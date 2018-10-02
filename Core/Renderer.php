<?php

namespace Core;

class Renderer
{
    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * @var array
     */
    protected $urlToTemplateMap;

    public function __construct()
    {
        $this->urlToTemplateMap = require_once __DIR__.'/../Config/urlToTemplate.php';
        if ((empty($this->urlToTemplateMap)) || (!is_array($this->urlToTemplateMap))) {
            throw new \Exception('Bad format of urlToTemplate config!');
        }

        $this->baseUrl = '//'.$_SERVER['SERVER_NAME'];
    }

    public function hasTemplate(Request $request): bool
    {
        return !empty($this->getTemplate($request));
    }

    public function render(Request $request)
    {
        $template = $this->getTemplate($request);
        if (empty($template)) {
            throw new \Exception(
                sprintf('Bad format of urlToTemplate config for %s uri!', $request->getUri())
            );
        }

        header($template->getHeader());
        echo str_replace('{{baseUrl}}', $this->baseUrl, file_get_contents(__DIR__.'/../Templates/'.$template->getFile()));
    }

    protected function getTemplate(Request $request): ?Template
    {
        if (empty(($this->urlToTemplateMap[$request->getUri()]))) {
            return null;
        }

        $found = $this->urlToTemplateMap[$request->getUri()];
        if ((!isset($found[0])) || (!isset($found[1]))) {
            throw new \Exception(
                sprintf('Bad format of urlToTemplate config for %s uri!', $request->getUri())
            );
        }

        return new Template($found[0],$found[1]);

    }
}