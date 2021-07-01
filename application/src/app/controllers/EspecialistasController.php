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
        # aca deberia pedirle al modelo que me traiga los especialistas para esa especialidad, o si no viene ninguna que me traiga todos

        header('Content-Type: application/json');
        if ($especialidad) echo json_encode([0 => ["nombre" => 'Juan Martin Del Pollo'], 1 => ["nombre" => 'Roger Federal']]);
        else echo json_encode([0 => ['nombre' => 'Homero Simpson'], 1 => ['nombre' => 'Bart Simpson'], 2 => ['nombre' => 'Lisa Simpson']]);
    }
}

?>