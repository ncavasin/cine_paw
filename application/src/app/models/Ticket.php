<?php

namespace Paw\app\models;

use Exception;
use Paw\core\Model;

class Ticket extends Model{
     
    # 1-1 relation 
    public $table = 'entradas';

    # Table columns
    public $fields = [
        "id_usuario"         => ["value" => null, "error" => null],
        "id_funcion"         => ["value" => null, "error" => null],
        "ubicacion"          => ["value" => null, "error" => null],
        "payment_id"         => ["value" => null, "error" => null],
    ];

    private function validIdUsuario($usuario){
        return true;
    }

    public function setId_usuario($usuario){
        if (! $this->validIdUsuario($usuario)){
            $this->fields['id_usuario']['error'] = 'Id del usuario es inválido.';
        }
        
        $this->fields['id_usuario']['value'] = $usuario;
    }

    private function validIdFuncion($idFuncion){
        return true;
    }

    public function setId_funcion($idFuncion){
        if (! $this->validIdFuncion($idFuncion)){
            $this->fields['id_funcion']['error'] = 'Id de Función es inválida.';
        }
        
        $this->fields['id_funcion']['value'] = $idFuncion;
    }

    private function validUbicacion($ubicacion){
        return true;
    }

    public function setUbicacion($ubicacion){
        if (! $this->validUbicacion($ubicacion)){
            $this->fields['ubicacion']['error'] = 'Ubicación inválida.';
        }
        
        $this->fields['ubicacion']['value'] = $ubicacion;
    }

    private function validPaymentId($idPayment){
        return true;
    }

    public function setPayment_id($idPayment){
        if (! $this->validPaymentId($idPayment)){
            $this->fields['payment_id']['error'] = 'Id de Payment inválida.';
        }
        
        $this->fields['payment_id']['value'] = 10; //$idPayment;
    }

    public function set(array $values){
        foreach(array_keys($this->fields) as $key){
            if((! isset($values[$key]))){
                $this->fields[$key]['error'] = "El campo no puede estar vacío ({$key})";
            }
            # Armo el nombre de la funcion a ejecutar para el setter correspondiente
            $method = 'set' . ucfirst($key);
            echo '<pre>';
            var_dump($method);
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
            foreach( $this->fields as $key => $field){
                $params[$key] = $field['value'];
                var_dump($params);
            }
            return $this->queryBuilder->insert($this->table, $params);
        } catch(Exception $e){
            echo '<pre>';
            echo var_dump($e);
            return false;
        }
    }
}