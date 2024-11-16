<?php
namespace Framework312\View;

use Framework312\Request;

abstract class BaseView{
    // La méthode use_template doit être implémentée dans les sous-classes
    // Elle prépare les données nécessaires à l'utilisation du template
    abstract protected function use_template();

    // La méthode render doit également être implémentée
    // Elle génère la réponse en fonction des données de la requête
    abstract protected function render(Request $request);

}

?>