<?php

namespace Paw\app\models;

use Paw\core\Model;
use Paw\app\models\Usuario;

class TurnosCollection extends Model
{
    public $table = 'turnos';

    public function getAll()
    {
        $turnos = $this->queryBuilder->select($this->table);
        $turnosCollection = [];
        foreach ($turnos as $turno) {
            $nuevoTurno = new Turno;
            $nuevoTurno->set($turno);
            $turnosCollection[] = $nuevoTurno;
        }
        return  $turnosCollection;
    }
}
