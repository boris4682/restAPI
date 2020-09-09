<?php

class Request
{
    private $method;
    private $URI;

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getURI(): string
    {
        return $this->URI;
    }

    /**
     * Request constructor.
     */
    function __construct()
    {
        $this->method = $_SERVER["REQUEST_METHOD"];
        $this->URI = $_SERVER["REQUEST_URI"];
    }

    /**
     * @param string $url
     * @return mixed
     */
    public function getUrlQuery($url)
    {
        $parts = parse_url($url);
        if (!empty($parts['query'])) {
            parse_str($parts['query'], $query);
            return $query;
        }
    }
}