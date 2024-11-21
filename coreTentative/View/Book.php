<?php

namespace Framework312\View;

use Symfony\Component\HttpFoundation\Request;
use Framework312\View\TemplateView;

class Book extends TemplateView
{
    /**
     * Gère les requêtes GET.
     */
    protected function get(Request $request): array
    {
        // Récupérer l'ID du livre à partir des paramètres de la route
        $id = $request->attributes->get('id', 'Inconnu');
        $id = $request->getPathInfo();
        // Retourner les données pour le template
        return [
            'title' => "Détails du Livre",
            'bookId' => $id,
            'description' => "Voici les détails du livre avec l'ID : $id.",
        ];
    }

    /**
     * Gère les requêtes POST (si nécessaire).
     */
    protected function post(Request $request): array
    {
        // Exemple de gestion de données POST
        $data = $request->request->all();

        return [
            'message' => 'Les données POST ont été reçues avec succès.',
            'postedData' => $data,
        ];
    }
}
