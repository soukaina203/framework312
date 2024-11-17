<?php
namespace Framework312\Views;

class Book {
    public function get($request) {
        // Exemple de données, vous pouvez personnaliser cela
        return ['id' => $request->getPath(), 'title' => 'Livre exemple'];
    }

    public function post($request) {
        // Exemple de données pour la méthode POST
        return ['message' => 'Données reçues pour le livre ID ' . $request->getPath()];
    }
}
?>
