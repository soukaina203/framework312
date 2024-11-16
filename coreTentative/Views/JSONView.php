<?php 
namespace Framework312\View;
use Framework312\Request;

class JSONView extends BaseView {
    protected function use_template() {
        // Pas de transformation des données
    }

    protected function render(Request $request) {
        // On retourne les données sous forme de JSON
        $data = ['status' => 'success', 'message' => 'Données traitées avec succès'];
        return json_encode($data);
    }
}




?>