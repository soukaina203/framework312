<?php

namespace Framework312\Router;

use Framework312\Interfaces\Router;
use Framework312\Interfaces\Renderer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SimpleRouter implements Router
{
    private $routes = [];
    private $renderer;

    public function __construct(Renderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * Register a new route with its associated View.
     * 
     * @param string $path
     * @param string $viewClass
     */
    public function register(string $path, string $viewClass)
    {
        $this->routes[$path] = $viewClass;

        // Debugging the routes
    }


    /**
     * Serve the incoming request by routing it to the appropriate View.
     */
    public function serve()
    {
        // 1. Créer une nouvelle instance de Request
        $request = Request::createFromGlobals(); // Utilise HttpFoundation
    
        // Récupérer le chemin demandé
        $path = $request->getPathInfo();
        echo "Requested Path: $path<br>";
    
        // 2. Chercher la vue qui correspond à la route
        $viewClass = null;
        foreach ($this->routes as $route) {
            // Utiliser une expression régulière pour capturer les paramètres dynamiques
            $regex = '#^' . str_replace(':id', '(\d+)', $route['path']) . '$#'; // Capture les paramètres :id
            if (preg_match($regex, $path, $matches)) {
                // Assigner la classe de la vue correspondante
                $viewClass = $route['viewClass'];
                
                // Assigner les paramètres capturés à la requête
                $request->attributes->set('id', $matches[1]); // Si :id est capturé, l'ajouter à la requête
                break;
            }
        }
    
        // 3. Si aucune vue n'a été trouvée, renvoyer une erreur 404
        if (!$viewClass) {
            $response = new Response('404 Not Found', 404);
            $response->send();
            return;
        }
    
        // 4. Instancier la Vue et rendre la réponse
        $view = new $viewClass();
        $response = $view->render($request);
    
   
        // Envoyer la réponse au client
        $response->send();
    }
    
}
