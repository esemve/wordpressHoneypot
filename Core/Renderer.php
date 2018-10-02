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
    protected $urlToTemplateMap = [
        '/'             => 'index.html',
        'sample-page'   => 'index.html',
        'author/smv'    => 'index.html',
        'category/uncategorized' => 'index.html',
        '2018/10/02/hello-world' => 'index.html',
        '2018/10'       => 'index.html',
        'feed'          => 'index.html',
        'comments/feed' => 'index.html',
        'wp-admin'      => 'admin.html',
        'login.php'     => 'admin.html'
    ];

    public function __construct()
    {
        if ((empty($this->urlToTemplateMap)) || (!is_array($this->urlToTemplateMap))) {
            throw new \Exception('Bad format of urlToTemplate config!');
        }

        $this->baseUrl = '//'.$_SERVER['SERVER_NAME'].':8081';
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

        header('text/html; charset=UTF-8');
        echo str_replace('{{baseUrl}}', $this->baseUrl, file_get_contents(__DIR__.'/../Templates/'.$template->getFile()));
    }

    protected function getTemplate(Request $request): ?Template
    {
        if (empty(($this->urlToTemplateMap[$request->getUri()]))) {
            return null;
        }

        return new Template($this->urlToTemplateMap[$request->getUri()]);
    }
}