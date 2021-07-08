<?php

namespace Paw\app\models;

use Exception;
use Paw\core\Model;

class Complex extends Model{
     
    # 1-1 relation 
    public $table = 'complejos';

    # Table columns
    public $fields = [
        "direccion"     => ["value" => null, "error" => null],
        "cp"            => ["value" => null, "error" => null],
        "localidad"     => ["value" => null, "error" => null],
    ];

    private function validDireccion($direccion){
        return true;
    }

    public function setDireccion($direccion){
        if (! $this->validDireccion($direccion)){
            $this->fields['direccion']['error'] = 'Dirección inválida.';
        }
        
        $this->fields['direccion']['value'] = $direccion;
    }

    private function validCp(){
        return true;
    }

    public function setCp($cp){
        if (! $this->validCp($cp)){
            $this->fields['cp']['error'] = 'Código Postal inválido.';
        }
        
        $this->fields['cp']['value'] = $cp;
    }

    private function validLocalidad($localidad){
        return true;
    }

    public function setLocalidad($localidad){
        if (! $this->validLocalidad($localidad)){
            $this->fields['localidad']['error'] = 'Localidad inválida.';
        }
        
        $this->fields['localidad']['value'] = $localidad;
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