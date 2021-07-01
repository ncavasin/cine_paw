<?php

namespace Paw\app\controllers;

use Paw\core\Controller;

use const Paw\core\database\FILE_SIZE_MAX;

class PageController extends Controller{

    private function validateEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) return true;
        return false;
    }

    private function validateDate($date) {
        $parsedDate = $this->parseDate($date); # llega con el formato aaaa-mm-dd
        if ((count($parsedDate) == 3) && checkdate($parsedDate[1], $parsedDate[2], $parsedDate[0])) return true;
        return false;
    }

    private function validatePassword($pass) {
        return strlen($pass) > 7;
    }

    private function validateForm($requiredValues) {
        $sanitized = [];
        foreach ($requiredValues as $key => $value){
            # guardo el sanitizado para las validaciones y su posterior devolucion como resultado
            # si es el campo contrasenia no lo sanitizo !!!
            $sanitized[$key] = $key == 'contrasenia' ? $_POST[$key] : $this->sanityCheck($_POST[$key]); 
            if ($value['validate']) { # me fijo si tiene un metodo para validar especifico
                if (!$value['validate']($sanitized[$key])) # si lo tiene, lo ejecuto
                    return [$sanitized, false, "El campo \"{$value['label']}\" no tiene un formato valido"]; # si no es valido respondo con mensaje personalizado
            } else if (!$sanitized[$key]) # si no tiene personalizado, uso el general
                return [$sanitized, false, "El campo  \"{$value['label']}\" no puede estar vacío"];
        }
        return [$sanitized, true, ''];
    }

    public function sanityCheck($field) {
        $field = trim($field);
        $field = stripslashes($field);
        $field = htmlspecialchars($field);
        return $field;
    }

    public function index(){
        $titulo = 'Dental Medical Group';
        require $this->viewsDir . 'index_view.php';
    }

    public function login($notification = false, $isValid = false, $notification_text = 'Uno o mas campos no son validos'){
        $titulo = 'Iniciar Sesión';
        $notification_type = $isValid ? SUCCESS : ERROR;
        require $this->viewsDir . 'login_view.php';
    }

    public function register($notification = false, $isValid = false, $notification_text = 'Uno o mas campos no son validos'){
        $titulo = 'Registrarse';
        $notification_type = $isValid? SUCCESS : ERROR;
        require $this->viewsDir . 'register_view.php';
    }

    public function registerProcess(){
        # array para saber si vienen los campos requeridos y validarlos segun sus requisitos
        $requiredValues = [
            'nombre' => ['label' => 'Nombre'],
            'apellido' => ['label' => 'Apellido'],
            'celular' => ['label' => 'Celular'],
            'email' => ['label' => 'Email', 'validate' => function ($email) {return $this->validateEmail($email);}],
            'conf_email' => ['label' => 'Email', 'validate' => function ($email) {return $this->validateEmail($email);}],
            'contrasenia' => ['label' => 'Contraseña', 'validate' => function ($pass) { return $this->validatePassword($pass);}],
            'conf_contrasenia' => ['label' => 'Contraseña', 'validate' => function ($pass) { return $this->validatePassword($pass);}],
            'fecha_nacimiento' => ['label' => 'Fecha de nacimiento', 'validate' => function ($date) {return $this->validateDate($date);}],
        ];
        # valido los campos
        list($validated, $isValid, $notification_text) = $this->validateForm($requiredValues); # validated viene sanitizado
        if (!$isValid) $this->register(true, false, $notification_text);
        # valido los campos que requieren confirmacion
        else if ($validated['email'] != $validated['conf_email']) $this->register(true, false, 'Los email no coinciden');
        else if ($validated['contrasenia'] != $validated['conf_contrasenia']) $this->register(true, false, 'Las contraseñas no coinciden');
        else $this->register(true, true, 'Registro completado con éxito');

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

    public function about(){
        $this->titulo = '¿Quiénes Somos?';
        require $this->viewsDir . 'about_view.php';
    }

    public function services(){
        $this->titulo = 'Nuestros Servicios';
        require $this->viewsDir . 'services_view.php';
    }

    public function coverages($busqueda = false, $isValid = false, $resultado = [], $notification = false, $notification_text = 'Uno o mas campos no son validos'){
        $this->titulo = 'Coberturas';
        $notification_type = $isValid? SUCCESS : ERROR;
        require $this->viewsDir . 'coverages_view.php';
    }

    public function coveragesProcess(){
        $requiredValues = [
            'busqueda' => ['label' => 'Busqueda'],
        ];
        $resultado = [];
        list($validated, $isValid, $notification_text) = $this->validateForm($requiredValues);
        if (!$isValid)
            $this->coverages(false, false, $resultado, true, $notification_text);
        else {
            if (strlen($validated['busqueda']) >= 3) $this->coverages(true, true, ['busqueda valida']); # Simulo obtener una respuesta de una base de datos
            else $this->coverages(false, false, $resultado, true, 'Ingrese al menos 3 caracteres');
        }
    }

    public function turns($notification = false, $isValid = false, $notification_text = 'Uno o mas campos no son validos'){
        $this->titulo = 'Turnos';
        $notification_type = $isValid ? SUCCESS : ERROR;
        require $this->viewsDir . 'turns_view.php';
    }
    
    public function turnsProcess(){
        $requiredValues= [
            'especialidad' => ['label' => 'Especialidad'],
            'especialista' => ['label' => 'Especialista'],
            'dia' => [  'label' => 'Dia', 
                        'validate' => function ($date) { return $this->validateDate($date);}]
        ];

        if(empty($_FILES)){
            $this->turns(true, false, 'El campo Orden Médica es obligatorio');
        } else if($_FILES['orden_medica']['error'] != 0){
            $this->turns(true, false, "El archivo no se envió correctamente");
        }else{
            list($validated, $isValid, $notification_text) = $this->validateForm($requiredValues);
            if (!$isValid) $this->turns(true, false, $notification_text);
            else{
                # Handling upload
                $finfo =        finfo_open(FILEINFO_MIME_TYPE);
                $timestamp =    time();
                $targetDir =    "./files/";
                $tempName =     $_FILES['orden_medica']['tmp_name'];
                $fileSize =     $_FILES['orden_medica']['size'];
                $newFileName =  $targetDir . $_FILES['orden_medica']['name']. '--' . $timestamp; # el -- es para despues parsear el nombre y devolver el original
                $mimeType =     finfo_file($finfo, $tempName);

                finfo_close($finfo);

                if (file_exists($newFileName))
                    $this->turns(true, false, 'Error al subir el archivo: Ya existe');
                else if ($fileSize > FILE_SIZE_MAX)
                    $this->turns(true, false, "Tamaño de archivo excedido. Limite 10Mb.");
                else if (! ($mimeType == 'application/pdf')){
                    $this->turns(true, false, 'El archivo no tiene una extensión válida (PDF)');
                }
                else{
                    if(!is_dir($targetDir)) mkdir($targetDir);
                    if (move_uploaded_file($_FILES["orden_medica"]["tmp_name"], $newFileName)) {
                        $this->turns(true, true, "Turno reservado con éxito");
                    } else {
                        $this->turns(true, false, "Error interno del servidor, no se pudo guardar el archivo");
                    }
                }
            }
        }
    }

    public function parseDate($field){
        return explode('-', $field);
    }

}
