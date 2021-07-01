<?php


namespace Paw\app\models;

use Paw\core\Model;

class Turno extends Model{

    # 1-1 relation against Turnos table
    public $table;

    # Table columns
    public $fields = [
        'fecha'         => null,
        'hora'          => null,
        'fk_intermedia' => null,
        'fk_usuario'    => null,
        'orden_path'    => null, # filesystem path
        'orden_nombre'  => null  # document as-user-uploaded name
    ];


    public function setFecha(string $fecha){
        # Validate fecha
    }

    public function setHora(string $hora){
        # Validate hora
    }

    public function setIntermedia(string $intermediaId){
        # Validate intermedia
    }

    public function setUsuario(string $usuarioId){
        # Validate usuario
    }

    public function setOrdenPath(string $ordenPath){
        $this->fields['orden_path'] = $ordenPath;
    }

    public function setOrdenName(string $ordenName){
        $this->fields['orden_name'] = $ordenName;
    }

    public function set(array $values){
        foreach(array_keys($this->fields) as $key){
            if(! isset($values[$key])){
                continue;
            }
            $method = 'set' . ucfirst($key);
            $method($values[$key]);
        }

    }

    public function isMedic($rol) {
        return $rol == 'medic';
    }
}

?>