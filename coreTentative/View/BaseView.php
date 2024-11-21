<?php
namespace Framework312\View;

use Symfony\Component\HttpFoundation\Request;

abstract class BaseView{
    // La méthode use_template doit être implémentée dans les sous-classes
    // Elle prépare les données nécessaires à l'utilisation du template
    abstract protected function use_template();
    abstract protected function render(Request $request);

    // La méthode render doit également être implémentée
    // Elle génère la réponse en fonction des données de la requête

}

?>