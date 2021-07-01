<?php

namespace Paw\app\controllers;

use Paw\core\Controller;

class ServicesController extends Controller{    
    public function audiologia() {
        $titulo = 'Audiología';
        $viewsDir = $this->viewsDir;
        require $this->viewsDir . 'servicios/audiologia_view.php';
    }
    
    public function cardiologia() {
        $titulo = 'Cardiología';
        $viewsDir = $this->viewsDir;
        require $this->viewsDir . 'servicios/cardiologia_view.php';
    }
    
    public function ecografiaDoppler() {
        $titulo = 'Ecografía doppler';
        $viewsDir = $this->viewsDir;
        require $this->viewsDir . 'servicios/ecografia_doppler_view.php';
    }
    
    public function densitometria() {
        $titulo = 'Densitometría';
        $viewsDir = $this->viewsDir;
        require $this->viewsDir . 'servicios/densitometria_view.php';
    }

}

?>