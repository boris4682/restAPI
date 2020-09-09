<?php

class Application
{
    private $routes;

    /**
     * Application constructor.
     */
    public function __construct($configRoutes)
    {
        $this->routes = include($configRoutes);
    }

    /**
     * @return void
     */
    public function start(): void
    {
        try {
            $request = new Request();
            $router = new Router($this->routes);
            $configRoute = $router->getRoutingData($request);
            $handler = new HandlerControllers($configRoute);
            $dataResponse = $handler->handle();
            $response = new Response(...$dataResponse);
            echo $response->getContentJSON();
        } catch (Exception $e) {
            $response = new Response(array('Error '.$e->getCode()=>$e->getMessage()), $e->getCode());
            echo $response->getContentJSON();
        }
    }
}