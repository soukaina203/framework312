<?php 

namespace Framework312\Interfaces;
use Framework312\Request;


interface Router {
    public function register(string $path, string|object $class_or_view);
    public function serve(mixed ...$args);
}


?>
