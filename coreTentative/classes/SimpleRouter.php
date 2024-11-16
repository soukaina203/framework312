<?php

namespace Framework312\Router;

use Framework312\Interfaces\Router;
use Framework312\Interfaces\classes;
use Framework312\Interfaces\Renderer;
use Framework312\Request;

require_once __DIR__ . '../../../vendor/autoload.php';



class SimpleRouter implements Router
{
    private array $routes = [];
    private Renderer $renderer;

    public function __construct(Renderer $engine)
    {
        $this->renderer = $engine;
    }

    /**
     * Enregistrer une route avec son modèle de chemin et sa classe de vue
     */
    public function register(string $path, string $viewClass): void
    {
        // Convertir les parties dynamiques (comme :id) en expressions régulières
        $pattern = preg_replace('#:([\w]+)#', '(?P<$1>[\w-]+)', $path);
        $pattern = "#^" . $pattern . "$#";

        // Enregistrer la route et sa classe associée
        $this->routes[] = [
            'pattern' => $pattern,
            'viewClass' => $viewClass,
        ];
    }

    /**
     * Traiter la requête et servir la réponse
     */
    public function serve(Request $request): void
    {
        // Recherche de la route correspondante
        foreach ($this->routes as $route) {
            if (preg_match($route['pattern'], $request->getPath(), $matches)) {
                // Récupérer le nom de la classe de vue associée
                $viewClass = $route['viewClass'];

                // Créer une instance de la classe de vue
                $view = new $viewClass();  // Créer l'instance de la classe
                

                $view = new $viewClass();

                // Appeler la méthode appropriée (GET ou POST)
                $method = strtolower($request->getMethod());
                $data = $view->$method($request);

                // Rendre la vue avec les données via le moteur de template
                echo $this->renderer->render('book.twig', $data);
                return;
            }
        }

        // Si aucune route n'est trouvée, afficher une erreur 404
        echo "404 Not Found";
    }
}
