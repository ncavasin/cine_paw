<?php

namespace Paw\app\models;

use Paw\core\database\Constants;
use Paw\core\exceptions\InvalidFormatException;
use Paw\core\Model;

use const Paw\core\database\ESPECIALIDAD_DESC_MAX;
use const Paw\core\database\ESPECIALIDAD_NOM_MAX;

class Especialidad extends Model{

    # 1-1 relation against Especialista table
    public $table = 'especialidades';

    # Table columns
    public $fields = [
        'nombre'    => null,
        'descripcion'  => null
    ];

    public function setNombre(string $nombre){

        if(strlen($nombre) > Constants::getEspNomMax()){
            throw new InvalidFormatException('Nombre de Especialidad  demasiado largo. Limite ' . Constants::getEspNomMax() . ' caracteres.');
        }

        $this->field['nombre'] = $nombre;
    }

    public function setDescripcion($descripcion){
        if(strlen($descripcion) > Constants::getEspDescMax()){
            throw new InvalidFormatException('Descripcion de la Especialidad demasiado largo. Limite ' . Constants::getEspDescMax() . ' caracteres.');
        }

        $this->field['descripcion'] = $descripcion;
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

    public function get() {
        return $this->queryBuilder->select($this->table, []);
    }

}

?>