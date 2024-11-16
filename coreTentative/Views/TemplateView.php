<?php
namespace Framework312\View;

use Framework312\Request;

class TemplateView extends BaseView {
    private $renderer;

    public function __construct($renderer) {
        $this->renderer = $renderer;
    }

    protected function use_template() {
        // Enregistre la vue (nom de la classe) avec le moteur de template
        $this->renderer->register(static::class);
    }

    protected function render(Request $request) {
        // Prépare les données pour le template et le rend
        $data = ['title' => 'Ma page Web', 'content' => 'Bienvenue sur ma page avec Twig!'];
        return $this->renderer->render($data, 'template.twig');
    }
}



?>