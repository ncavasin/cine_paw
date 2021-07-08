<?php

namespace Paw\app\controllers;

use Paw\core\Controller;

class TicketController extends Controller{
    
    public function ticketInfo(){
        require $this->viewsDir . 'sel_tickets_view.php';
    }
}