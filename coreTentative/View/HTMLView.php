<?php 
namespace Framework312\View;

use Framework312\Request;
class HTMLView extends BaseView {
    protected function use_template() {
        // Pas de transformation des données
    }

    protected function render(Request $request) {
        // Retourne un contenu HTML simple, par exemple
        return "<html><body>Bienvenue sur ma page HTML!</body></html>";
    }
}
?>