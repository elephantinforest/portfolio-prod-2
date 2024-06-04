<?php

class Response
{
    protected string $content;
    protected int $statusCode = 200;
    protected string $statusText = 'OK';



    public function send(): void
    {
        if (!headers_sent()) {
            header('HTTP/1.1 ' . $this->statusCode . ' ' . $this->statusText);
        }
        echo $this->content;
    }


    public function setContent(string $content): void
    {
        $this->content = $content;
    }


    public function setStatusCode(int $statusCode, string $statusText): void
    {
        $this->statusCode = $statusCode;
        $this->statusText = $statusText;
    }

    public function getContent(): string
    {
        return $this->content;
    }
    public function getStatusCode(): string
    {
        return $this->statusCode;
    }
    public function getStatusText(): string
    {
        return $this->statusText;
    }
}
