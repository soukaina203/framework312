<?php
namespace Framework312\View;

use Framework312\Request;
use Symfony\Component\HttpFoundation\Response;

class TemplateView extends BaseView {
    private $renderer;

    public function __construct($renderer) {
        $this->renderer = $renderer;
    }
    

    protected function use_template() {
        // Enregistre la vue (nom de la classe) avec le moteur de template
        $this->renderer->register(static::class);
    }

    protected function render( $request) {
      
            // Récupérer l'ID de la route (en supposant que l'ID est un nombre)
            $id = $request->attributes->get('id', 'Inconnu');
    
            // Créer le contenu de la réponse
            $content = "<h1>Book ID: $id</h1>";
            return new Response($content, 200);
    }
}   



?>