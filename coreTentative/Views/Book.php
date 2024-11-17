<?php

namespace Framework312\Views;

use Framework312\View\TemplateView;
use Symfony\Component\HttpFoundation\Request;

class Book extends TemplateView
{
    /**
     * Handle GET requests.
     */
    public function get(Request $request): array
    {
        // Retrieve the route parameter (e.g., /book/:id -> id = 123)
        $id = $request->attributes->get('id'); 

        // Return data for the template
        return ['title' => "Book ID: $id"];
    }

    /**
     * Handle POST requests (if needed).
     */
    public function post(Request $request): array
    {
        // Process POST data from the request
        $data = $request->request->all();

        // Example response for POST
        return ['message' => 'POST request received', 'data' => $data];
    }

}
