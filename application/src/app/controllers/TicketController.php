<?php

namespace Paw\app\controllers;

use Paw\core\Controller;
use Paw\app\models\Ticket;

class TicketController extends Controller{
    public ?string $modelName = Ticket::class;

    public function selectTickets() {
        require $this->viewsDir . 'sel_tickets_view.php';
    }

    public function setSelectedTickets() {
        if (isset($_SESSION)) {
            $_SESSION['childCount'] = $_POST['child'];
            $_SESSION['generalCount'] = $_POST['general'];
            $_SESSION['ticketsCount'] = $_POST['general'] + $_POST['child'];
            header("Location: /select_seats");
        } else {
            require $this->viewsDir . 'internal_error_view.php';
        }
    }

    public function cancelTickets() {
        if (isset($_SESSION)) {
            session_destroy();
        }
    }

    public function getRoomInfo() {
        # consulta a la base de datos para obtener los asientos que estan ocupados
        if (isset($_SESSION)){
            $response = [
                'ticketsCount' => $_SESSION['ticketsCount'],
                'occuped' => [
                    '0' => 'a1',
                    '1' => 'a2',
                    '2' => 'h4',
                    '3' => 'h5',
                    '4' => 'h6',
                ]
            ];
            header('content-type: application/json');
            echo json_encode($response);
        } else echo '500 internal error';
    }

    public function selectSeats() {
        require $this->viewsDir . 'sel_butacas_view.php';
    }

    public function ticketInfo(){
        $titulo = 'Comprar entrada';

        require $this->viewsDir . 'sel_tickets_view.php';
    }

    public function newTicket(){
        global $log;


        $isValid = true;
        $notification_text = 'Entrada reservada con éxito!';
        # setear los campos  -> devuelve bool
        $values = [
            "id_usuario" => $_POST['id_usuario'],
            "id_funcion" => $_POST['id_funcion'],
            "ubicacion" => $_POST['ubicacion'],
            "payment_id" => $_POST['payment_id']
        ];
        
        var_dump("newTicket endpoint hit", $values);
        
        if ($isValid) {

            # Get model data
            $isValid = $this->model->get($values);


        if ($values['pwd'] != $_POST['conf_pwd']) {
            $isValid = false;
            $notification_text = 'Las contraseñas no coinciden';
        }

            # Set model data with the posted content
            $result = $this->model->set($values);

            # Check for error
            foreach($result as $item) {
                $isValid = is_null($item['error']) && $isValid;
            }
            
            if ($isValid) 
                $isValid = $this->model->save();

            if (!$isValid) {
                $notification_text = 'Error al intentar reservar la entrada, revise los logs para mas información.';
                $log->debug('Error al reservar la entrada', [$result, $isValid]);
            }
        } else {
            $notification_text = 'No se ha podido reservar la entrada.';
        }

        $titulo = 'Reserva entrada';
        $notification = true;
        $notification_type = $isValid ? SUCCESS : ERROR;
        require $this->viewsDir . 'sel_tickets_view.php';
    }

}