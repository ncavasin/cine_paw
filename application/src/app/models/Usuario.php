<?php

namespace Paw\app\models;

use Exception;
use Paw\core\Model;
use Paw\core\database\Constants;

class Usuario extends Model{
    
    # 1-1 relation against Usuarios table
    public $table = 'usuarios';

    # Table columns
    public $fields = [
        "nombre"            => ["value" => null, "error" => null],
        "apellido"          => ["value" => null, "error" => null],
        "dni"               => ["value" => null, "error" => null],
        "fnac"              => ["value" => null, "error" => null],
        "celular"           => ["value" => null, "error" => null],
        "mail"              => ["value" => null, "error" => null],
        "pwd"               => ["value" => null, "error" => null], 
    ];

    public function setNombre(string $nombre){
        if (strlen($nombre ) > Constants::getNomApMax()){
            $this->fields['nombre']['error'] = 'Nombre de Usuario demasiado largo. Limite: '. Constants::getNomApMax() . ' caracteres.';
        }
        $this->fields['nombre']['value'] = $nombre;
    }

    public function setApellido(string $apellido){
        if (strlen($apellido ) > Constants::getNomApMax()){

            $this->fields['apellido']['error'] = 'Apellido de Usuario demasiado largo. Limite: ' . Constants::getNomApMax() . ' caracteres.';
        }
        $this->fields['apellido']['value'] = $apellido;
    }

    private function parseDate($field){
        return explode('-', $field);
    }

    private function validDate($date){
        $parsedDate = $this->parseDate($date); # llega con el formato aaaa-mm-dd
        if ((count($parsedDate) == 3) && checkdate($parsedDate[1], $parsedDate[2], $parsedDate[0])) return true;
        return false;
    }

    public function setFnac($fnac){
        if(! $this->validDate($fnac)){
            $this->fields['fnac']['error'] = 'Fecha de Nacimiento de Usuario inválida.';
        }
        # Copy paste logic from Page Controllers
        $this->fields['fnac']['value'] = $fnac;
    }

    private function validDni(&$dni){
        # Remove dots if any
        $dni = str_replace(".", "", $dni);
        
        if(strlen($dni) > Constants::getDniMax()) return false;

        # Convert string to integer
        $dni = intval($dni);

        return true;
    }

    public function setDni($dni){
        #echo '<pre>';
        #var_dump($dni);
        
        if(! $this->validDni($dni)){
            $this->fields['dni']['error'] = 'DNI de Usuario inválido.';
        }
        
        #var_dump($dni);
        $this->fields['dni']['value'] = $dni;
    }

    private function validarCelular(){
        # Handle verification: regex?
        return true;
    }

    public function setCelular($celular){
        if(! $this->validarCelular($celular)){
            $this->fields['celular']['error'] = 'Celular del Usuario inválido.';
        }
        $this->fields['celular']['value'] = $celular;
    }

    private function validarMail($mail){
        if(! filter_var($mail, FILTER_VALIDATE_EMAIL)){
            return false;
        }
        return true;
    }

    public function setMail($mail){
        if (! $this->validarMail($mail)){
            $this->fields['mail']['error'] = 'Mail inválido.';
            return false;
        } 
        $this->fields['mail']['value'] = $mail;
        return true;
    }

    public function setPwd($pwd){
        if (! isset($pwd)){
            $this->fields['pwd']['error'] = 'Contraseña vacía.';
            return false;
        }
        $this->fields['pwd']['value'] = password_hash($pwd, PASSWORD_DEFAULT);
        return true;
    }


    public function set(array $values){
        foreach(array_keys($this->fields) as $key){
            if((! isset($values[$key]))){
                $this->fields[$key]['error'] = "El campo no puede estar vacío ({$key})"; # TODO si no encuentra la variable deberia tirar un error 
            }
            # Armo el nombre de la funcion a ejecutar para el setter correspondiente
            $method = 'set' . ucfirst($key);
            $this->$method($values[$key]);
        }
        return $this->fields;
    }


    public function login(array $values){
        $isValid = true;

        if (! isset($values['mail']) || ! isset($values['pwd'])) return false;
        $result = $this->queryBuilder->selectUsuario($this->table, $values);

        # Si no devuelve SOLO 1 USER, login fallido
        if(count($result) != 1) return false;
        $user = $result[0]; # tengo que agarrar el primer elemento, porque es un arreglo de arreglos
        
        # vardump para testear que funciona
        /* var_dump($user);
        var_dump('Password de la request: ' . $values['pwd']);
        var_dump('Password en la db (sin descifrar): ' . $user['pwd']);
        var_dump('¿Password en la db coincide?');
        var_dump(password_verify($values['pwd'], $user['pwd'])); */

        if (!password_verify($values['pwd'], $user['pwd'])) return [false]; # Verifico el hash de la pass y retorno falso si no coinciden

        # Sigo si coinciden
        $user['pwd'] = null;
        return [$isValid, $user];
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

    public function get($values) {
        $result = $this->queryBuilder->select($this->table, $values);
        return count($result) == 0;
    }
}

