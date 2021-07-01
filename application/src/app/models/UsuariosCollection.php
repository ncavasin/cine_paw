<?php

namespace Paw\app\models;

use Paw\core\Model;
use Paw\app\models\Usuario;

class UsuariosCollection extends Model {
    public $table = 'usuarios';

    public function getAll(){
        $usuarios = $this->queryBuilder->select($this->table);
        $usuariosCollection = [];
        foreach($usuarios as $usuario){
            $nuevoUsuario = new Usuario;
            $nuevoUsuario->set($usuario);
            $usuariosCollection[] = $nuevoUsuario;
        }
        return $usuariosCollection;
    }
}