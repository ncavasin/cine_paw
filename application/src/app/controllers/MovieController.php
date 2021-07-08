<?php

namespace Paw\app\controllers;

use Paw\core\Controller;

class MovieController extends Controller {
    public function movieInfo() {
        require $this->viewsDir . 'sel_tickets_view.php';
    }
}