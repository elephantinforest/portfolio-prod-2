<?php

class Router
{
    /** @phpstan-ignore-next-line */
    private array $routes;

    public function __construct()
    {

        $this->routes = $this->registerRoutes();
    }

    public function resolve(string $pathInfo): mixed
    {
        $path = urldecode($pathInfo); // URLデコード
        $path = htmlspecialchars($path); // URLデコード

        if (preg_match('/\/update\?location_id=[0-9]+/', $path)) {
            return ['controller' => 'Update', 'action' => 'return'];
        }
        if (preg_match("/\/update\?id=[0-9]+/", $pathInfo)) {
            return ['controller' => 'Update', 'action' => 'index'];
        }


        if (preg_match('/^\/search\?search=.+$/u', $path)) {
            return ['controller' => 'Search', 'action' => 'index'];
        }

        if (preg_match('/^\/prev\?locationId=.+$/u', $path)) {
            return ['controller' => 'Locations', 'action' => 'return'];
        }
        if (preg_match('/^\/next\?locationId=.+$/u', $path)) {
            return ['controller' => 'Locations', 'action' => 'return'];
        }

        foreach ($this->routes as $path => $pattern) {
            if ($path === $pathInfo) {
                return $pattern;
            }
        }
        return false;
    }

    /** @phpstan-ignore-next-line */
    private function registerRoutes(): array
    {
        return [
            '/acount' => ['controller' => 'Acount', 'action' => 'index'],
            '/acount/create' => ['controller' => 'Acount', 'action' => 'create'],
            '/login' => ['controller' => 'Login', 'action' => 'index'],
            '/logout' => ['controller' => 'Logout', 'action' => 'index'],
            '/user' => ['controller' => 'Login', 'action' => 'user'],
            '/register' => ['controller' => 'Register', 'action' => 'index'],
            '/register/location' => ['controller' => 'Register', 'action' => 'update'],
            '/register/name' => ['controller' => 'Register', 'action' => 'name'],
            '/position' => ['controller' => 'Position', 'action' => 'index'],
            '/locationupload' => ['controller' => 'Locations', 'action' => 'index'],
            '/update' => ['controller' => 'Update', 'action' => 'update'],
            '/delete' => ['controller' => 'Delete', 'action' => 'delete'],
            '/pagenation' => ['controller' => 'Pagenation', 'action' => 'index'],
            '/resize' => ['controller' => 'Resize', 'action' => 'index'],
        ];
    }

    public function getRoutes() {
        return $this->routes;
    }
}
