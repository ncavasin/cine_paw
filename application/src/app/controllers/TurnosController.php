<?php

namespace Paw\app\controllers;

use Exception;
use Paw\core\Controller;
use Paw\app\models\Turno;
use PhpOption\None;
use Paw\core\database\Constants;

class TurnosController extends Controller
{

    public ?string $modelName = Turno::class;

    # Lista todos los turnos disponibles a una fecha y hora det
    public function nuevoTurno()
    {
        $notification = true;
        $notification_text = 'Turno reservado con éxito';
        $isValid = true;
        $titulo = 'Mis turnos';

        if (empty($_FILES)) {
            $notification_text = 'Falta completar la orden medica (Documento PDF)';
            $isValid = false;
        } else if ($_FILES['orden_medica']['error'] == 1) {
            $notification_text = 'Tamaño de archivo máximo excedido';
            $isValid = false;
        }
        if ($_FILES['orden_medica']['error'] != 0) {
            $notification_text = 'Ocurrio un error al cargar la orden medica';
            $isValid = false;
        } else {
            $finfo =        finfo_open(FILEINFO_MIME_TYPE);
            $timestamp =    time();
            $targetDir =    "./files/";
            $tempName =     $_FILES['orden_medica']['tmp_name'];
            $fileSize =     $_FILES['orden_medica']['size'];
            $newFileName =  $targetDir . $_FILES['orden_medica']['name'] . '--' . $timestamp;

            $mimeType =     finfo_file($finfo, $tempName);
            finfo_close($finfo);
            if (file_exists($newFileName)) {
                $isValid = false;
                $notification_text = 'Error: Nombre de archivo ya existente';
                # TODO Este error nunca deberia agregarse, siempre deberia poder crear otro nombre asociado en caso de coincidir
            } else if ($fileSize > Constants::getFileSize()) {
                $isValid = false;
                $notification_text = 'Tamaño de archivo máximo superado (' . (Constants::getFileSize() / 1000000) . ' MB)';
            } else if (!($mimeType == 'application/pdf')) {
                $isValid = false;
                $notification_text = 'El archivo seleccionado no es un documento PDF válido';
            } else {
                if (!is_dir($targetDir)) mkdir($targetDir);
                if (move_uploaded_file($_FILES["orden_medica"]["tmp_name"], $newFileName)) {
                    # TODO aca comienza el proceso de guardar en la base de datos 
                    try {
                        echo var_dump($_POST['fecha']);
                        $values = [
                            'id_especialista' => 1, # $_POST['id_especialista'], # hardcoded porque todavia no manejo los id en frontend, solo los nombres
                            'fecha'         => date('Y-m-d', $_POST['fecha'] / 1000
                        ), # siempre guarda el turno para hoy a modo de testing
                            'hora'          => explode(':', $_POST['hora'])[0],
                            'minuto'        => explode(':', $_POST['hora'])[1],
                            'id_usuario'    => 1, # hardcoded porque no tenemos sesiones ni cookies implementadas
                            'orden_medica'    => $newFileName, # filesystem path
                            'nombre_orden_medica'  => $_FILES['orden_medica']['name']  # document as-user-uploaded name
                        ];
                        $isValid = $this->model->set($values); # esto deberia validar los campos como en el Usuarios model pero no lo hace todavia
                        $isValid = $this->model->save();
                        if (!$isValid) $notification_text = 'Error al guardar el turno';
                    } catch (Exception $e) {
                        $notification_text = 'Error al cargar los datos';
                        $isValid = false;
                    }
                }
            }
        }
        $notification_type = $isValid ? SUCCESS : ERROR;
        require $this->viewsDir . 'turns_view.php';
        # TODO Luego del testing, cambiar esta vista por la de mis turnos (Para mejor usabilidad)
    }

    public function getTurnosDisponibles()
    {
        header('Content-Type: application/json');
        echo file_get_contents(__DIR__ . '/turnos.json');
    }

    # Lista un solo turno
    public function getTurnos()
    {
        require $this->viewsDir . 'my_turns_view.php';
        /* $turnosCollection = $this->model->getAll();
        var_dump($turnosCollection);die; */
    }

    public function getWaitingList()
    {
        $rol = $_GET['rol']; # En esta variable vendría el rol del usuario para saber que script cargar en la pagina, si el de medico o el de usuario
        $isMedic = false;
        if ($this->model->isMedic($rol)) {
            $isMedic = true;
        }
        require $this->viewsDir . 'waiting_list_view.php';
    }
}
