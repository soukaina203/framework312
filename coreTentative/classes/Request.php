<?php

namespace Framework312;

class Request {
    private string $path;
    private string $method;

    public function __construct(string $path, string $method) {
        $this->path = $path;
        $this->method = $method;
    }

    public function getPath(): string {
        return $this->path;
    }

    public function getMethod(): string {
        return $this->method;
    }
    
    // Extraire l'id de l'URL (si applicable)
    public function getId(): ?string {
        if (preg_match('#/book/([\w-]+)#', $this->path, $matches)) {
            return $matches[1];
        }
        return null;
    }
}
