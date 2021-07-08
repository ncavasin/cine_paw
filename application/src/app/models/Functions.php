<?php

namespace Paw\app\models;

use Exception;
use Paw\core\Model;

class Functions extends Model{

    # 1-1 relation 
    public $table = 'funciones';

    # Table columns
    public $fields = [
        "id_sala"           => ["value" => null, "error" => null],
        "id_pelicula"       => ["value" => null, "error" => null],
        "id_tipo_funcion"   => ["value" => null, "error" => null],
        "horario"           => ["value" => null, "error" => null],
    ];


    public function setIdSala($idSala){
        if (! isset($idSala)){
            $this->fields['id_sala']['error'] = 'Id de Sala inválido.';
        }
        
        $this->fields['id_sala']['value'] = $idSala;
    }

    public function setIdPelicula($idPelicula){
        if (! isset($idPelicula)){
            $this->fields['id_pelicula']['error'] = 'ID de Pelicula vacío.';
        }
        
        $this->fields['id_pelicula']['value'] = $idPelicula;
    }

    public function setIdTipoFuncion($idTipoFunc){
        if (! isset($idTipoFunc)){
            $this->fields['id_tipo_funcion']['error'] = 'ID de Tipo de Función vacío.';
        }
        
        $this->fields['id_tipo_funcion']['value'] = $idTipoFunc;
    }

    private function validHorario(){
        return true;
    }

    public function setHorario($horario){
        if (! isset($horario)){
            $this->fields['horario']['error'] = 'Horario inválido.';
        }
        
        $this->fields['horario']['value'] = $horario;
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