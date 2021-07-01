<?php


namespace Paw\app\models;

use Exception;
use Paw\core\Model;

class Turno extends Model{

    # 1-1 relation against Turnos table
    public $table = 'turnos';

    # Table columns
    public $fields = [
        'id_especialista' => null,
        'fecha'         => null,
        'hora'          => null,
        'minuto'        => null,
        'id_usuario'    => null,
        'orden_medica'    => null, # filesystem path
        'nombre_orden_medica'  => null  # document as-user-uploaded name
    ];


    public function setFecha($fecha){
        $fields['fecha'] = $fecha;
    }

    public function setHora($hora){
        $fields['hora'] = $hora;
    }
    public function setMinuto($minuto){
        $fields['minuto'] = $minuto;
    }

    public function setIdEspecialista(string $idEspecialista){
        $fields['id_especialista'] = $idEspecialista;
    }

    public function setUsuario(string $idUsuario){
        $fields['id_usuario'] = $idUsuario;
    }

    public function setOrdenMedica(string $ordenMedica){
        $this->fields['orden_medica'] = $ordenMedica;
    }

    public function setNombreOrdenMedica(string $nombreOrdenMedica){
        $this->fields['nombre_orden_medica'] = $nombreOrdenMedica;
    }

    public function set(array $values){
        $this->fields = $values;
        return true;
        # sin validar porque no hay tiempo y falta refactorizar a nuevo diseño de la bd
        foreach(array_keys($this->fields) as $key){
            if(! isset($values[$key])){
                continue;
            }
            $method = 'set' . ucfirst($key);
            $method($values[$key]);
        }

    }

    public function save() {
        try {
            $params = $this->fields;
            return $this->queryBuilder->insert($this->table, $params);
        } catch (Exception $e) {
            echo '<pre>';
            echo var_dump($e);
            return false;
        }
    }

    # esta funcion simula consultar a la base de datos por el rol de un usuario
    public function isMedic($rol) {
        return $rol == 'medic';
    }
}

?>