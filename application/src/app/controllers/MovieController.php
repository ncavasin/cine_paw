<?php

namespace Paw\app\controllers;

use Paw\core\Controller;
use Paw\app\models\Movie;

class MovieController extends Controller {
    public ?string $modelName = Movie::class;

    public function movieInfo() {
        require $this->viewsDir . 'confirm_order_view.php';
    }
}