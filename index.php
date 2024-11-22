<?php
require_once __DIR__ . '/coreTentative/classes/TwigRenderer.php'; // Inclure ta classe
require_once __DIR__ . '/coreTentative/classes/SimpleRouter.php'; // Inclure ta classe
require_once __DIR__ . '/vendor/autoload.php';

use Framework312\Renderer\TwigRenderer;
use Framework312\Router\SimpleRouter;

// Initialiser le chemin des templates
$engine = new TwigRenderer('./templates/');

//  $engine->render(['Any' => 'jfd'], 'test.html');

 $router = new SimpleRouter($engine);

 $router->register('/book/:id', \Framework312\View\Book::class);
//  
 $router->serve();

//

?>
