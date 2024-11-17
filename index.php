<?php
require_once __DIR__ . '/coreTentative/classes/TwigRenderer.php'; // Inclure ta classe
require_once __DIR__ . '/coreTentative/classes/SimpleRouter.php'; // Inclure ta classe
require_once __DIR__ . '/coreTentative/classes/Request.php'; // Inclure ta classe
require_once __DIR__ . '/vendor/autoload.php';

use Framework312\Renderer\TwigRenderer;
use Framework312\Router\SimpleRouter;
use Framework312\Request;

// class Book extends TemplateView {
//     public function get(Request $request)  {
     
//         return $this->render(
//             [['id' => 2, 'title' =>"any", 'author' => "any"]],
//             'test.html'
//         );
//     }

//     public function post(Request $request) {
     
//         return $this->render(
//             ['message' => 'Book successfully created!'],
//             'success.twig'
//         );
//     }
// }

// Initialiser le chemin des templates
$engine = new TwigRenderer('./templates/');

echo $engine->render(['name' => 'jfd'], 'test.html');

$router = new SimpleRouter($engine);

 $router->register('/book/:id', 'Framework312\Views\Book');
  $router->serve();


// Créer une instance de SimpleRouter avec le moteur Twig
// $router = new SimpleRouter($engine);

// // Enregistrer la route /book/:id avec la classe Book
// $router->register('/book/:id', 'Framework312\Book'); // Utiliser le namespace complet

// Simuler une requête GET sur /book/123

// Servir la requête via le routeur
?>
