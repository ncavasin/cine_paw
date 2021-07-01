<?php

namespace Paw\app\controllers;

use Paw\core\Controller;

class ErrorController extends Controller{


    public function __construct(){
        parent::__construct();
    }

    
    public function notFound(){
        http_response_code(404);
        require $this->viewsDir . 'not_found_view.php';
    }

    public function internalError(){
        http_response_code(500);
        $titulo = 'Error interno del servidor';
        require $this->viewsDir . 'internal_error_view.php';
    }
}

?>