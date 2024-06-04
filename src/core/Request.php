<?php

class Request
{
    public function isPost(): bool
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return true;
        }
        return false;
    }

    public function getPathInfo(): string
    {
        return $_SERVER['REQUEST_URI'];
    }
}
