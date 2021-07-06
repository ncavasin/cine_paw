<?php

namespace Paw\core\database;

const FILE_SIZE_MAX = 10000000;
const NOM_AP_MAX = 50;
const CEL_MAX = 30;
const MAIL_MAX = 50;
const PWD_MIN = 7;
const PWD_MAX = 255;

const DIR_MAX = 100;
const PEL_MAX = 250;
const DESC_MAX = 2500;
const UBI_MAX = 3; // ej: entrada J24 -> fila J col 24.
const TIPO_MAX = 20;


class Constants{

    public static function getFileSize(){
        return FILE_SIZE_MAX;
    }

    public static function getNomApMax(){
        return NOM_AP_MAX;
    }

    public static function getCelMax(){
        return CEL_MAX;
    }
    
    public static function getMailMax(){
        return MAIL_MAX;
    }

    public static function getPwdMin(){
        return PWD_MIN;
    }

    public static function getPwdMax(){
        return PWD_MAX;
    }

    public static function getDirMax(){
        return DIR_MAX;
    }

    public static function getPelMax(){
        return PEL_MAX;
    }

    public static function getTipoMax(){
        return TIPO_MAX;
    }
    
    public static function getDescMax(){
        return DESC_MAX;
    }

}

?>