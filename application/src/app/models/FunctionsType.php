<?php

namespace Paw\app\models;

use Exception;
use Paw\core\Model;

class Functions extends Model{

    # 1-1 relation 
    public $table = 'tipo_funciones';

    # Table columns
    public $fields = [
        "descripcion"       => ["value" => null, "error" => null],
        "precio"            => ["value" => null, "error" => null],
    ];


    private function validDescripcion(descripcion){
        if(! isset($descripcion) || strlen($descripcion) > Constants::getTipoDescMax())
            return false
        return true;
    }

    public function setDescripcion($descripcion){
        if (! $this->validDescripcion($descripcion)){
            $this->fields['descripcion']['error'] = 'Tipo de Funcion inválida.';
        }
        
        $this->fields['descripcion']['value'] = $descripcion;
    }

    private function validPrecio($precio){
        if(! isset($precio) || ! gettype($precio) == 'float')
            return false;
        return true;
    }

    public function setPrecio($precio){
        if (! $this->validPrecio($precio)){
            $this->fields['precio']['error'] = 'Precio inválido.';
        }
        
        $this->fields['precio']['value'] = $precio;
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