<?php

namespace Paw\app\controllers;

use Paw\core\Controller;

class PaymentController extends Controller {
    public function paymentInfo() {
        require $this->viewsDir . 'payment_view.php';
    }
    
}