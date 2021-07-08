<?php

namespace Paw\core\database;

const FILE_SIZE_MAX = 10000000;
const NOM_AP_MAX = 50;
const CEL_MAX = 30;
const MAIL_MAX = 50;
const PWD_MIN = 7;
const PWD_MAX = 255;

const GEN_MAX = 35;
const TITULO_MAX = 250;
const SINOPSIS_MAX = 2500;
const TIPO_DESC_MAX = 50;
const UBI_MAX = 3;      // ej: entrada J24 -> fila J col 24.
const LINK_MAX = 300;
const DIR_MAX = 100;
const LOC_MAX = 100;
const DNI_LEN = 8;
const IMDB_MAX = 20;


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

    public static function getGenMax(){
        return GEN_MAX;
    }

    public static function getTituloMax(){
        return TITULO_MAX;
    }
    
    public static function getSinopsisMax(){
        return SINOPSIS_MAX;
    }

    public static function getTipoDescMax(){
        return TIPO_DESC_MAX;
    }

    public static function getUbiMax(){
        return UBI_MAX;
    }

    public static function getLocMax(){
        return LOC_MAX;
    }

    public static function getLinkMax(){
        return LINK_MAX;
    }

    public static function getDniMax(){
        return DIR_MAX;
    }

    public static function getImdbMax(){
        return IMDB_MAX;
    }

}

?>