<?php

namespace Paw\app\controllers;

use Paw\app\models\Especialidad;
use Paw\core\Controller;


class EspecialidadesController extends Controller{
    
    public ?string $modelName = Especialidad::class;

    # Lista todas las especialidades
    public function index(){

    }

    # Lista una especialidad
    public function getEspecialidad(){
        
    }

    public function getEspecialidades(){
        $especialidades = $this->model->get();
        header('Content-Type: application/json');
        echo json_encode($especialidades);
    }
}

?>