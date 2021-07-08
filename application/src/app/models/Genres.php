<?php

namespace Paw\app\models;

use Exception;
use Paw\core\Model;
use Paw\core\database\Constants;

class Genres extends Model{
     
    # 1-1 relation 
    public $table = 'generos';

    # Table columns
    public $fields = [
        "nombre"     => ["value" => null, "error" => null],
    ];

    private function validNombre($nombre){
        if(! isset($nombre) || strlen($nombre) > Constants::getGenMax())
            return false;
        return true;
    }

    public function setNombre($nombre){
        if (! $this->validNombre($nombre)){
            $this->fields['nombre']['error'] = 'Género inválido.';
        }
        
        $this->fields['nombre']['value'] = $nombre;
    }
    
    public function set(array $values){
        foreach(array_keys($this->fields) as $key){
            if((! isset($values[$key]))){
                $this->fields[$key]['error'] = "El campo no puede estar vacío ({$key})";
            }
            # Armo el nombre de la funcion a ejecutar para el setter correspondiente
            $method = 'set' . ucfirst($key);
            $this->$method($values[$key]);
        }
        return $this->fields;
    }

    public function get($values) {
        $result = $this->queryBuilder->select($this->table, $values);
        return count($result) == 0;
    }

    public function save() {
        try{
            $params = [];
            foreach( $this->fields as $key => $field) $params[$key] = $field['value'];
            return $this->queryBuilder->insert($this->table, $params);
        } catch(Exception $e){
            echo '<pre>';
            echo var_dump($e);
            return false;
        }
    }
}