<?php

namespace Paw\app\models;
use Paw\core\Model;



class ObraSocial extends Model{

    # 1-1 relation against ObrasSociales table
    public $table;

    # Table columns
    public $fields = [
        'nombre'    => null,
    ];

    public function set(string $nombre){

        #Handle this 

        $this->fields['nombre'] = $nombre;
    }

}
?>