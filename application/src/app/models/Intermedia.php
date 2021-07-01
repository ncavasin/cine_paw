<?php

class Intermedia extends Models{

    # 1-1 relation against Intermedia table
    public $table;

    # Table columns
    public $fields = [
        'fk_especialista'  => null,
        'fk_especialidad'  => null
    ];
    
    public function setRelation($especialistaId, $especialidadId){
        # Handle insertion 
    }


}

?>