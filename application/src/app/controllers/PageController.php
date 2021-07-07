<?php

namespace Paw\app\controllers;

use Paw\core\Controller;

use const Paw\core\database\FILE_SIZE_MAX;

class PageController extends Controller{
    public function sanityCheck($field) {
        $field = trim($field);
        $field = stripslashes($field);
        $field = htmlspecialchars($field);
        return $field;
    }

    public function index(){
        $titulo = 'Cine PAW';
        require $this->viewsDir . 'index_view.php';
    }

    public function login($notification = false, $isValid = false, $notification_text = 'Uno o mas campos no son validos')
    {
        $titulo = 'Iniciar Sesión';
        $notification_type = $isValid ? SUCCESS : ERROR;
        require $this->viewsDir . 'login_view.php';
    }

    public function register($notification = false, $isValid = false, $notification_text = 'Uno o mas campos no son validos')
    {
        $titulo = 'Registrarse';
        $notification_type = $isValid ? SUCCESS : ERROR;
        require $this->viewsDir . 'register_view.php';
    }

    public function resetPassword($notification = false, $isValid = false, $notification_text = 'Uno o mas campos no son validos'){
        $notification_type = $isValid? SUCCESS : ERROR;
        require $this->viewsDir . 'reset_password_view.php';
    }

    public function resetPasswordProcess(){
        $requiredValues = [
            'email' => ['label' => 'Email', 'validate' => function ($email) {return $this->validateEmail($email); }],
        ];

        list($validated, $isValid, $notification_text) = $this->validateForm($requiredValues);
        if (!$isValid) $this->resetPassword(true, false, $notification_text);
        else $this->resetPassword(true, true, 'Revise su casilla de email para continuar con el proceso');
    }
    
    public function parseDate($field){
        return explode('-', $field);
    }

}
