<?php

namespace Paw\app\models;

use Paw\core\database\Constants;
use Paw\core\Model;
use Paw\core\exceptions\InvalidFormatException;

use const Paw\core\database\USER_NOM_AP_MAX;

class Especialista extends Model{

    # 1-1 relation against Especialista table
    public $table;

    # Table columns
    public $fields = [
        'nombre'    => null,
        'apellido'  => null
    ];

    public function setNombre(string $nombre){
        
        if (strlen($nombre ) > Constants::getNomApMax()){

            throw new InvalidFormatException('Nombre de Usuario demasiado largo. Limite: ' . Constants::getNomApMax() . ' caracteres.');
        }

        $this->fields['nombre'] = $nombre;
    }

    public function setApellido(string $apellido){

        if (strlen($apellido ) > Constants::getNomApMax()){

            throw new InvalidFormatException('Apellido de Usuario demasiado largo. Limite: ' . Constants::getNomApMax() . ' caracteres.');
        }
        
        $this->fields['apellido'] = $apellido;
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

}



?>