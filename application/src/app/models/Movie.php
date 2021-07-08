<?php

namespace Paw\app\models;

use Exception;
use Paw\core\Model;
use Paw\core\database\Constants;

class Movie extends Model{
     
    # 1-1 relation against Usuarios table
    public $table = 'peliculas';

    # Table columns
    public $fields = [
        "imdb_id"           => ["value" => null, "error" => null],
        "titulo"            => ["value" => null, "error" => null],
        "sinopsis"          => ["value" => null, "error" => null],
        "duracion"          => ["value" => null, "error" => null],
        "id_genero"         => ["value" => null, "error" => null],
        "fecha_estreno"     => ["value" => null, "error" => null],
        "trailer"           => ["value" => null, "error" => null], 
        "valoracion"        => ["value" => null, "error" => null], 
        "activa"            => ["value" => null, "error" => null]
    ];

    private function validImdbId($imdbId){
        return true;
    }

    public function setImdbId($imdbId){
        if (! $this->validTitulo($imdbId)){
            $this->fields['imdb_id']['error'] = 'IMDb Id es inválido.';
        }
        
        $this->fields['imdb_id']['value'] = $imdbId;
    }

    private function validtitulo($titulo){
        return true;
    }

    public function setTitulo($titulo){
        if (! $this->validTitulo($titulo)){
            $this->fields['titulo']['error'] = 'Titulo inválido.';
        }
        
        $this->fields['titulo']['value'] = $titulo;
    }

    private function validSinopsis($sinopsis){
        if(strlen($sinopsis) > Constants::getSinopsisMax()) return false;
        return true;
    }

    public function setSinopsis($sinopsis){
        if (! $this->validSinopsis($sinopsis)){
            $this->fields['sinopsis']['error'] = 'Sinopsis demasiado larga.';
        }
        
        $this->fields['sinopsis']['value'] = $sinopsis;
    }   

    private function validDuracion($duracion){
        return true;
    }

    public function setDuracion($duracion){
        if (! $this->validDuracion($duracion)){
            $this->fields['duracion']['error'] = 'Duración vacía.';
        }
        $this->fields['duracion']['value'] = $duracion;
    }

    private function validGenero($idGenero){
        if(! isset($idGenero)) return false;
        return true;
    }

    public function setIdGenero($idGenero){
        if (! $this->validGenero($idGenero)){
            $this->fields['id_genero']['error'] = 'Id de Genero inválido.';
        }
        
        $this->fields['id_genero']['value'] = $idGenero;
    }

    public function setFechaEstreno($fechaEstreno){
        if (! isset($fechaEstreno)){
            $this->fields['fecha_estreno']['error'] = 'Fecha de estreno vacía.';
        }
        
        $this->fields['fecha_estreno']['value'] = $fechaEstreno;
    }

    private function validTrailer($trailer){
        if(strlen($trailer) > Constants::getUrlMax()) return false;
        return true;
    }

    public function setTrailer($trailer){
        if (! $this->validTrailer($trailer)){
            $this->fields['trailer']['error'] = 'Trailer demasiado largo.';
        }
        $this->fields['trailer']['value'] = $trailer;
    }

    public function validValoracion($valoracion){
        if((! gettype($valoracion) == 'float') || ($valoracion > 10.0 && $valoracion < 0.0)) 
            return false;
        return true;
    }

    public function setValoracion($valoracion){
        if (! $this->validValoracion($valoracion)){
            $this->fields['valoracion']['error'] = 'Valoracion vacío.';
        }
        
        $this->fields['valoracion']['value'] = $valoracion;
    }

    public function setActiva($activa){
        if (! isset($activa)) $this->fields['activa']['error'] = 'Activa vacío.';

        $this->fields['activa']['value'] = $activa;
    }

    public function save(){
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

    public function get($values) {
        $result = $this->queryBuilder->select($this->table, $values);
        return count($result) == 0;
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
}