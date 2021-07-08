<?php

namespace Paw\app\controllers;

use DateTime;
use Exception;
use Paw\core\Controller;
use Paw\app\models\Ticket;

class TicketController extends Controller
{
    public ?string $modelName = Ticket::class;

    public function selectTickets()
    {
        require $this->viewsDir . 'sel_tickets_view.php';
    }

    public function setSelectedTickets()
    {
        if (isset($_SESSION)) {
            $_SESSION['movie'] = 'Iron Man 4';
            $_SESSION['date'] = '09/07/2021';
            $_SESSION['hour'] = '19:00';
            $_SESSION['ticketType'] = '2D';
            $_SESSION['functionId'] = 1;
            $_SESSION['lang'] = 'Subtitulado';
            $_SESSION['childCount'] = $_POST['child'];
            $_SESSION['generalCount'] = $_POST['general'];
            $_SESSION['ticketsCount'] = $_POST['general'] + $_POST['child'];
            header("Location: /select_seats");
        } else {
            require $this->viewsDir . 'internal_error_view.php';
        }
    }

    public function cancelTickets()
    {
        if (isset($_SESSION)) {
            session_destroy();
        }
    }

    public function getRoomInfo()
    {
        # consulta a la base de datos para obtener los asientos que estan ocupados
        if (isset($_SESSION)) {
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
        } else echo 'session timeout';
    }

    public function selectSeats()
    {
        require $this->viewsDir . 'sel_butacas_view.php';
    }

    public function setSelectedSeats()
    {
        if (isset($_SESSION)) {
            $post = trim(file_get_contents('php://input'));
            $_SESSION['seats'] = json_decode($post, true)['selected'];
            header("Location: /confirm_payment");
        } else echo 'session timeout';
    }

    public function confirmPayment()
    {
        if (isset($_SESSION)) {
            $seats = $_SESSION['seats'];
            $child = $_SESSION['childCount'];
            $general = $_SESSION['generalCount'];
            $movie = $_SESSION['movie'];
            $ticketType = $_SESSION['ticketType'];
            $date = $_SESSION['date'];
            $hour = $_SESSION['hour'];
            $lang = $_SESSION['lang'];
            require $this->viewsDir . 'confirm_order_view.php';
            die;
        } else require $this->viewsDir . 'internal_error.php';
    }

    public function payment_result()
    {
    }

    public function ticketInfo()
    {
        $titulo = 'Comprar entrada';
        require $this->viewsDir . 'sel_tickets_view.php';
    }

    private function sanitize($values)
    {

        # Escape everything
        foreach ($values as $k => $v) {
            $values[$k] = htmlspecialchars($v);

            # To mayus if string
            if (gettype($v) == 'string')
                $values[$k] = strtoupper($v);
        }

        return $values;
    }

    public function newTicket()
    {
        try {
            global $log;

            $isValid = true;
            $notification_text = 'Entrada reservada con éxito!';

            $sanitizedPost = $this->sanitize($_POST);

            # armo el array de tickets
            $values = [];
            if (isset($_SESSION)) {
                $seats = $_SESSION['seats'];
                $userId = $_SESSION['userId'];
                $functionId = $_SESSION['functionId'];
                $paymentId = null; # simula mercadopago id
                foreach ($seats as $key => $value) {
                    $newItem = [
                        'id_usuario' => $userId,
                        'id_funcion' => $functionId,
                        'ubicacion' => $value,
                        'payment_id' => $paymentId,
                    ];
                    $values[$key] = $newItem;
                }
            } else {
                require $this->viewsDir . 'internal_error_view.php';
                die();
            }
            if ($isValid) {

                # Me traigo todas las entradas que pertenecen a la funcion de la nueva entrada
                # $isValid = $this->model->get($values);

                # Set model data with the posted content
                # $result = $this->model->set($values);

                # Check for error
                /* foreach ($result as $item) {
                    $isValid = is_null($item['error']) && $isValid;
                } */

                if ($isValid)
                    $isValid = $this->model->save($values);
                else {
                    $notification_text = 'Error al intentar reservar la entrada, revise los logs para mas información.';
                    $log->debug('Error al reservar la entrada', [$result, $isValid]);
                }
            } else {
                $notification_text = 'No se ha podido reservar la entrada.';
            }

            $titulo = 'Reserva entrada';
            $notification = true;
            $notification_type = $isValid ? SUCCESS : ERROR;
            require $this->viewsDir . 'index_view.php';
        } catch (Exception $e) {
            echo '<pre>';
            echo var_dump($e);
        }
    }
}
