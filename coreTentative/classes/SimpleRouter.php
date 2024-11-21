<?php

    namespace Framework312\Router;

    use Framework312\Interfaces\Router;
    use Framework312\Interfaces\Renderer;
    use Framework312\View\Book;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

    use Framework312\Router\Exception as RouterException;

    class Route
    {
        private const VIEW_CLASS = 'Framework312\Router\View\BaseView';
        private const VIEW_USE_TEMPLATE_FUNC = 'use_template';
        private const VIEW_RENDER_FUNC = 'render';

        private string $view;

        public function __construct(string|object $class_or_view)
        {
            $reflect = new \ReflectionClass($class_or_view);
            $view = $reflect->getName();
            // if (!$reflect->isSubclassOf(self::VIEW_CLASS)) {
            //     throw new RouterException\InvalidViewImplementation($view);
            // }
            $this->view = $view;
        }

        public function call(Request $request, ?Renderer $engine): Response
        {
            $view = new $this->view($engine);
            return $view->render($request);
        }
    }


    class SimpleRouter implements Router
    {
        private Renderer $engine;
        public array $routes=[];

        public function __construct(Renderer $engine)
        {
            $this->engine = $engine;
            // TODO
        }

        public function register(string $path, string|object $class_or_view)
        {
            // $parts = explode("/", $path);
            $this->routes = array_merge(
                $this->routes,
                [$path => $class_or_view]
            );
            
        }

        public function serve(mixed ...$args): void
        {
            $request = Request::createFromGlobals();
            $path = $request->getPathInfo();
            $view ="";
            foreach($this->routes as $key => $value){
                if ($key==$path) {
                   $view=$value;
               
                   break;
                }
            }
            if ($view!="") {
                $route = new Route($view);
                $response = $route->call($request, $this->engine);
                $response->prepare($request);
                $response->send();
            }else{
                echo "hi";
                print_r($this->routes);
            }

        }
    }
