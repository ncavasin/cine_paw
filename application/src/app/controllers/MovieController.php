<?php

namespace Paw\app\controllers;

use Paw\core\Controller;

use const Paw\core\database\FILE_SIZE_MAX;

class MovieController extends Controller {
    public function movieInfo() {
        require $this->viewsDir . 'confirm_order_view.php';
    }
}