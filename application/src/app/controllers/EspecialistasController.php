<?php

namespace Paw\app\controllers;

use Paw\app\models\Especialista;
use Paw\core\Controller;


class EspecialistasController extends Controller{
    
    public ?string $modelName = Especialista::class;

    # Lista una especialidad
    public function getEspecialista(){
        
    }

    public function getEspecialistas(){
        global $log;
        $especialidad = $_GET['especialidad'];
        $especialistas = $this->model->get($especialidad);
        $response = [];
        foreach ($especialistas as $key => $value){
            $response[$key]['nombre'] = $value['nombre'] . ' ' . $value['apellido'];
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}

?>