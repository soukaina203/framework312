<?php 

namespace Framework312\Interfaces;
use Framework312\Request;


interface Router {
    public function register(string $path, string $view);
    public function serve();
}


?>
