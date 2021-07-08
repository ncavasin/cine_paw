<?php

namespace Paw\app\models;

use Exception;
use Paw\core\Model;

class Room extends Model{
     
    # 1-1 relation 
    public $table = 'salas';

    # Table columns
    public $fields = [
        "id_complejo"    => ["value" => null, "error" => null],
        "numero"         => ["value" => null, "error" => null],
    ];

    private function validIdComplejo($idComplejo){
        return true;
    }

    public function setIdComplejo($idComplejo){
        if (! $this->validIdComplejo($idComplejo)){
            $this->fields['id_complejo']['error'] = 'Id Complejo es inválida.';
        }
        
        $this->fields['id_complejo']['value'] = $idComplejo;
    }

    private function validNumero($numero){
        return true;
    }

    public function setNumero($numero){
        if (! $this->validNumero($numero)){
            $this->fields['numero']['error'] = 'Numero de sala inválido.';
        }
        
        $this->fields['numero']['value'] = $numero;
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