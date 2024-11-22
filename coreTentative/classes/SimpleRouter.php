<?php
namespace Framework312\Router;

use Framework312\Interfaces\Router;
use Framework312\Interfaces\Renderer;
use Framework312\View\Book;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Framework312\Router\Exception as RouterException;

// Classe Route représente une route associée à une vue spécifique
class Route
{
    // Constante définissant la classe de base pour les vues
    private const VIEW_CLASS = 'Framework312\Router\View\BaseView';
    
    // Constante indiquant la fonction pour utiliser un template (non utilisée ici)
    private const VIEW_USE_TEMPLATE_FUNC = 'use_template';
    
    // Constante indiquant la fonction pour rendre une vue
    private const VIEW_RENDER_FUNC = 'render';
    
    // Variable pour stocker la classe ou la vue associée
    private string $view;
    
    // Constructeur qui initialise la vue à partir d'une classe ou d'un objet
    public function __construct(string|object $class_or_view)
    {
        // Utilisation de la réflexion pour examiner la classe de la vue
        $reflect = new \ReflectionClass($class_or_view);
        
        // Récupération du nom de la classe de la vue
        $view = $reflect->getName();
        
        // Vérifie que la classe héritée est une sous-classe de VIEW_CLASS
        // if (!$reflect->isSubclassOf(self::VIEW_CLASS)) {
        //     // Lance une exception si ce n'est pas le cas
        //     throw new RouterException\InvalidViewImplementation($view);
        // }
        
        // Stocke la classe de la vue si elle est valide
        $this->view = $view;
    }
    
    // Méthode utilisée pour appeler la vue et générer une réponse HTTP
    public function call(Request $request, ?Renderer $engine): Response
    {
        // Crée une nouvelle instance de la vue avec le moteur de rendu
        $view = new $this->view($engine);
        
        // Appelle la méthode render pour produire la réponse HTTP
        return $view->render($request); // cette methode se trouve dans le templateView et puisque Book herite tous de cette class donc lui aussi a l access au methode serve 
    }
}











// Classe SimpleRouter gère les routes et leur correspondance avec les vues
class SimpleRouter implements Router
{
    // Variable pour le moteur de rendu des vues
    private Renderer $engine;
    
    // Tableau pour stocker les routes enregistrées
    public array $routes = [];
    
    // Constructeur pour initialiser le moteur de rendu
    public function __construct(Renderer $engine)
    {
        // Le moteur de rendu est injecté à l'initialisation
        $this->engine = $engine;
    }
    
    // Méthode pour enregistrer une nouvelle route
    public function register(string $path, string|object $class_or_view)
    {
        // Ajoute une nouvelle route dans le tableau des routes existantes
        $this->routes = array_merge(
            $this->routes,
            [$path => $class_or_view]
        );
    }
    
    // Méthode pour traiter la requête et servir la réponse correspondante
    public function serve(mixed ...$args): void
    {
        // Crée une requête HTTP à partir des superglobales PHP
        $request = Request::createFromGlobals();
        
        // Récupère le chemin demandé dans la requête
        $path = $request->getPathInfo();
        
        // // Affiche le chemin demandé pour le débogage
        // echo $path;
        
        // Initialise la variable pour stocker la vue associée
        $view = "";
        
        // Recherche une route correspondant au chemin demandé
        foreach ($this->routes as $key => $value) {
            // Si une correspondance est trouvée, récupère la vue associée
            if ($this->matchRoute($key, $path)) {
                $view = $value;
                break;
            }
        }
        
        // Si une vue correspondante est trouvée
        if ($view != "") {
            // Crée une nouvelle route avec la vue correspondante
            $route = new Route($view);
            
            // Appelle la vue et génère une réponse HTTP
            $response = $route->call($request, $this->engine);
            
            // Prépare la réponse avant de l'envoyer
            $response->prepare($request);
            
            // Envoie la réponse 
            $response->send();
        } else {
            // Si aucune vue n'est trouvée, affiche un message d'erreur
            echo "Vue non trouvée";
            
            // Affiche la liste des routes enregistrées pour le débogage
            print_r($this->routes);
        }
    }
    

    private function matchRoute(string $routePath, string $currentPath): bool
    {
        // Remplace les segments dynamiques (comme :id) par une expression régulière
        $pattern = preg_replace('/:\w+/', '(\w+)', $routePath);
        
        // Ajoute les délimiteurs pour indiquer le début et la fin de l'expression régulière
        $pattern = '#^' . $pattern . '$#';
        
        // Vérifie si le chemin actuel correspond au modèle
        return (bool)preg_match($pattern, $currentPath);
    }
    
}