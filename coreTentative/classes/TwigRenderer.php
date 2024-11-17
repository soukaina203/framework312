<?php

namespace Framework312\Renderer;

require_once 'coreTentative/Interfaces/Renderer.php'; // Adjust path accordingly

require_once __DIR__ . '../../../vendor/autoload.php';

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Framework312\Interfaces\Renderer;

class TwigRenderer implements Renderer
{
    private $cheminTemplate;

    public function __construct(string $cheminTemplate)
    {
        $this->cheminTemplate = $cheminTemplate;
    }

    public function render(mixed $data, string $template): string
    {
        // Initialiser le moteur Twig
        $loader = new FilesystemLoader($this->cheminTemplate);
        $twig = new Environment($loader);

        // Rendre le template avec les données fournies
        return $twig->render($template, $data);
    }

    public function register(string $tag)
    {
        // À compléter si des tags Twig personnalisés sont nécessaires
    }
}
