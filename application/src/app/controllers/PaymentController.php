<?php

namespace Paw\app\controllers;

use Paw\core\Controller;
use Paw\app\models\Payment;

class PaymentController extends Controller {
    public ?string $modelName = Payment::class;
    
    public function paymentInfo() {
        require $this->viewsDir . 'payment_view.php';
    }
    
}