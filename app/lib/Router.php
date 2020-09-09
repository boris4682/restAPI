<?php

class Router
{
    private $routes;

    /**
     * Router constructor.
     * @param array $routes
     */
    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getRoutingData(Request $request): array
    {
        $uri = $this->getURI($request);
        $method = $request->getMethod();
        $routeConfig = $this->generateRoutingData($uri, $method);
        $routeConfig['queryParams'] = $request->getUrlQuery($uri);
        return $routeConfig;
    }

    /**
     * @param string $uri
     * @param string $currentMethod
     * @return array
     */
    private function generateRoutingData($uri, $currentMethod): array
    {
        $path = $this->findPath($uri);
        $allowedMethod = $path['method'][0];
        if (!$this->isValidHttpMethod($currentMethod, $allowedMethod)) {
            throw new Exception(' 405 Method Not Allowed', 405);
        }
        $routeConfig = $this->parseURI($path);
        return $routeConfig;
    }

    /**
     * @param Request $request
     * @return string
     */
    private function getURI(Request $request): string
    {
        $uri = $request->getURI();
        if (!empty($uri)) {
            return rtrim($uri, '/');
        }
    }

    /**
     * @param string $uri
     * @return mixed
     * @throws Exception
     */
    private function findPath($uri)
    {
        foreach ($this->routes as $uriPattern => $path) {
            if ($this->isEqualURI($uriPattern, $uri)) {
                return $path;
            }
        }
        throw new  Exception(' 404 Page Not Found',404);
    }

    /**
     * @param string $uriPattern
     * @param string $uri
     * @return int
     */
    private function isEqualURI($uriPattern, $uri): int
    {
        return preg_match("~$uriPattern~", $uri);
    }

    /**
     * @param string $currentMethod
     * @param string $allowedMethod
     * @return bool
     */
    public function isValidHttpMethod($currentMethod, $allowedMethod): bool
    {
        return !strcmp($currentMethod, $allowedMethod);
    }

    /**
     * @param array $path
     * @return array
     */
    private function parseURI($path): array
    {
        $controllerName = strtok($path['action'], '@');
        $actionName = substr($path['action'], stripos($path['action'], '@') + 1);
        return ['controller' => $controllerName, 'action' => $actionName];
    }
}