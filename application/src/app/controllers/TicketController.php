<?php

namespace Paw\app\controllers;

use Paw\core\Controller;

class TicketController extends Controller{
    
    public function ticketInfo(){
        global $log;


        $isValid = true;
        $notification_text = 'Entrada comprada con éxito!';
        # setear los campos  -> devuelve bool
        $values = [
            "id_usuario" => $_POST['id_usuario'],
            "id_funcion" => $_POST['id_funcion'],
            "ubicacion" => $_POST['ubicacion'],
            "payment_id" => $_POST['payment_id']
        ];

        if ($isValid) {
            $isValid = $this->model->get($values);
            $result = $this->model->set($values);
            foreach($result as $item) {
                $isValid = is_null($item['error']) && $isValid;
            }
            if ($isValid) $isValid = $this->model->save();
            if (!$isValid) {
                $notification_text = 'Error al intentar comprar, revise los logs para mas información.';
                $log->debug('Error al comprar la entrada', [$result, $isValid]);
            }
            # si salio bien le damos save
            # si hay problemas devolvemos error
        } else {
            $notification_text = 'No se ha podido comprar la entrada.';
        }

        $titulo = 'Comprar entrada';
        $notification = true;
        $notification_type = $isValid ? SUCCESS : ERROR;
        require $this->viewsDir . 'sel_tickets_view.php';
    }


}