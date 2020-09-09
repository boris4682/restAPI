<?php

class HandlerControllers
{
    private $routeConfig;
    const STATUS_CODE_OK = 200;

    /**
     * HandlerControllers constructor.
     * @param array $routeConfig
     */
    public function __construct($routeConfig)
    {
        $this->routeConfig = $routeConfig;
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        $controllerObject = new $this->routeConfig['controller'];
        $responseData = $this->runAction($controllerObject, $this->routeConfig['action']);
        return $responseData;
    }

    /**
     * @param mixed $controllerObject
     * @param string $actionName
     * @return array
     */
    private function runAction($controllerObject, $actionName): array
    {
        $queryParams = array_values($this->routeConfig['queryParams'] ?? []);
        $result = $controllerObject->$actionName(...$queryParams);
        $status_code = self::STATUS_CODE_OK;
        return [$result, $status_code];
    }
}