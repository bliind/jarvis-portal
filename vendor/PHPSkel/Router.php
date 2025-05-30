<?php

namespace PHPSkel;

class Router
{
    protected $routes;
    protected $rootDir;
    private $extraPath = 'jarvis/';

    public function __construct($rootDir)
    {
        $this->rootDir = $rootDir;
        $this->makeRoutes();
    }

    private function makeRoutes()
    {
        $yaml = new Yaml();
        $routeArray = $yaml->load($this->rootDir . '/config/routes.yml');
        foreach ($routeArray as $name => $details) {
            $this->routes[$details['path']] = $details['controller'];
        }
    }

    private function findAction($uri)
    {
        if (isset($this->routes[$uri])) {
            return [
                'action' => $this->routes[$uri],
                'params' => []
            ];
        }

        foreach ($this->routes as $path => $action) {
            $re = '@' . preg_replace('/\{\w+\}/', '(.+)', $path) . '@';
            preg_match($re, $uri, $matches);
            if (!empty($matches) && $matches[0] == $uri) {
                array_shift($matches);
                return [
                    'action' => $action,
                    'params' => $matches,
                ];
            }
        }

        return false;
    }

    /**
     * Creates a response from a file in public
     * as long as it's not a PHP file
     * 
     * @param string $route
     * @return Response|null
     */
    private function assetRoute(string $route)
    {
        $route = substr($route, 1);
        $route = str_replace($this->extraPath, '', $route);
        if (strlen($route) == 0 || $route === '.htaccess') {
            return null;
        }

        $file = ROOTDIR . '/web/' . $route;
        if (substr($file, -4) !== '.php' && file_exists($file)) {
            return Response::fromFile($file);
        }
    }

    public function route($request)
    {
        $uri = $request->getUri();
        try {
            if ($assetResponse = $this->assetRoute($uri)) {
                return $assetResponse;
            }

            if ($route = $this->findAction($uri)) {
                $split = explode(':', $route['action']);

                $controllerClass = 'App\Controller\\' . $split[0] . 'Controller';

                $controller = new $controllerClass($request);
                return $controller->runAction($split[1], $route['params']);
            } else {
                throw new HttpException(null, '404');
            }
        } catch (HttpException $httpException) {
            return $httpException->getResponse();
        }
    }
}
