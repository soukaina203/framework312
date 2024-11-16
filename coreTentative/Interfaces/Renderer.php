<?php 

namespace Framework312\Interfaces;

interface Renderer {
    public function render(mixed $data, string $template): string;
    public function register(string $tag);
}


?>
