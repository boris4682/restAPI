<?php

class Response
{
    private $content;
    private $statusCode;
    const HTTP_PROTOCOL = "HTTP/1.1";

    /**
     * Response constructor.
     * @param mixed $content
     * @param int $statusCode
     * @param array $headers
     */
    public function __construct($content, $statusCode)
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
    }

    /**
     * @return void
     */
    private function setHeader(): void
    {
        header("Content-Type: application/json");
        header(self::HTTP_PROTOCOL . ' ' . $this->statusCode);
    }

    /**
     * @return false|string
     */
    public function getContentJSON()
    {
        $this->setHeader();
        return json_encode($this->content,JSON_UNESCAPED_UNICODE);
    }
}