<?php

namespace Paw\app\controllers;

use Paw\core\Controller;

class MovieController extends Controller {
    public function movieInfo() {
        require $this->viewsDir . 'confirm_order_view.php';
    }
}