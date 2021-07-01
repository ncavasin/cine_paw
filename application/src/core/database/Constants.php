<?php

namespace Paw\core\database;

const FILE_SIZE_MAX = 10000000;
const NOM_AP_MAX = 50;
const CEL_MAX = 30;
const MAIL_MAX = 50;
const PWD_MIN = 7;
const PWD_MAX = 255;
const ESPECIALIDAD_NOM_MAX = 50;
const ESPECIALIDAD_DESC_MAX = 500;
const SERVICIOS_NOM_MAX = 50;
const OS_NOM_MAX = 50;

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

    public static function getEspNomMax(){
        return ESPECIALIDAD_NOM_MAX;
    }

    public static function getEspDescMax(){
        return ESPECIALIDAD_DESC_MAX;
    }

    public static function getServNomMax(){
        return SERVICIOS_NOM_MAX;
    }

    public static function getOsNomMax(){
        return OS_NOM_MAX;
    }
    

}

?>