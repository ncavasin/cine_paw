<?php

namespace Paw\core\database;

use Exception;
use PDO;
use Monolog\Logger;
use Paw\core\core\exceptions\QBMissingValues;
use Paw\core\core\exceptions\QBInvalidTable;
use PDOException;

class QueryBuilder {
    public function __construct(PDO $pdo, Logger $logger){
        $this->pdo = $pdo;
        $this->logger = $logger;
    }

    public function selectUsuario($table, $params){

        if((! isset($params['mail'])) || (! isset($params['pwd']))) return false;

        $where =  "mail = :mail";
        $query = "select * from {$table} where {$where}";

        $sentencia = $this->pdo->prepare($query);
        $sentencia->bindValue(":mail", $params['mail']);
        
        $sentencia->setFetchMode(PDO::FETCH_ASSOC);
        $sentencia->execute();
        return $sentencia->fetchAll();
    }

    public function selectEspecialista($especialidad) {
        $join = '';
        if (isset($especialidad) && $especialidad != '') 
            $join = 'join especialidades as ep on ep.nombre = :especialidad join intermedia as it on ( es.id = it.id_especialista and ep.id = it.id_especialidad)';
        $query = 'select es.nombre, es.apellido, es.id from especialistas as es ' . $join;
        $sentencia = $this->pdo->prepare($query);
        if (isset($especialidad) && $especialidad != '') $sentencia->bindValue(':especialidad', $especialidad);
        $this->logger->info($query);
        $sentencia->setFetchMode(PDO::FETCH_ASSOC);
        $sentencia->execute();
        return $sentencia->fetchAll();
    }

    # Solo funciona con id o mail
    public function select($table, $params = []){
        $where = '1 = 1';
        if (isset($params['id'])) $where = "id = :id";
        if (isset($params['mail'])) $where = "mail = :mail";
        $query = "select * from {$table} where {$where}";
        $sentencia = $this->pdo->prepare($query);
        if (isset($params['id'])) $sentencia->bindValue(":id", $params['id']);
        if (isset($params['mail'])) $sentencia->bindValue(":mail", $params['mail']);
        $sentencia->setFetchMode(PDO::FETCH_ASSOC);
        $sentencia->execute();
        return $sentencia->fetchAll();
    }

    private function dispatcher($table, $keyword){
        if($table == 'usuarios'){
            # IMPORTANTE sin la especificacion de las columnas antes, no anda (porque sino espera que le pases el id tambien y es autoincremental)
            return '(nombre, apellido, dni, fnac, celular, mail, pwd) '. $keyword .' (:nombre, :apellido, :dni, :fnac, :celular, :mail, :pwd)';
        }
        else if($table == 'turnos'){
            return '(id_usuario, hora, id_especialista, minuto, fecha, orden_medica, nombre_orden_medica) ' 
            . $keyword . ' (:id_usuario, :hora, :id_especialista, :minuto, :fecha, :orden_medica, :nombre_orden_medica)';
        }
        return null;
    }

    # Params: <colname, value_to_insert>
    public function insert($table, $params = []){
        if(! isset($params)){
            $this->logger->error('Error insertando. No se recibieron valores.');
            #throw new QBMissingValues('No se recibieron los valores necesarios para insertar.');
        }else{

            $query = "insert into {$table} ";
            $values = $this->dispatcher($table, 'VALUES');

            if(! $values){
                $this->logger->debug('Error insertando en tabla ' . $table . '. No existe.');
                #throw new QBInvalidTable('No existe la tabla ' . $table);
            }

            $query = $query . $values;

            try{
                $statement = $this->pdo->prepare($query);
                $statement->execute($params); # TODO falta hacer bindValue
                $this->logger->info('Insercion en ' . $table . '. Sentencia: ' . $query . '. Parametros: ', [$params]);

            }catch(PDOException  $e){
                $this->logger->debug('Error insertando en tabla ['. $table . ']. Sentencia: [' . $query . ']. Parametros: [' . $params . '].');
                $this->logger->error('stacktrace', [$e]);
                return false;
            }
            return true;
        }
    }

    # La idea es recuperar TODAS las columnas de la/s tupla/s afectadas
    # y modificar SOLO las recibidas en $params, el resto queda igual.
    # P
    public function update($table, $params = []){

        if(! isset($params)){
            $this->logger->error('Error actualizando. No se recibieron valores.');
            throw new QBMissingValues('No se recibieron los valores necesarios para actualizar.');
        }else{

            # Recuperar la/s tupla/s a actualizar

            $query = "update {$table} ";
            $values = $this->dispatcher($table, 'SET');

            if(! $values){
                $this->logger->debug('Error acutalizando en tabla ' . $table . '. No existe.');
                throw new QBInvalidTable('No existe la tabla ' . $table);
            }

            $where = '';

            $query = $query . $values . $where;

            try{
                $statement = $this->pdo->prepare($query);
                $statement->execute($params);
                $this->logger->info('Actualizacion en ' . $table . '. Sentencia: ' . $query . '. Parametros: ', [$params]);

            }catch(PDOException  $e){
                $this->logger->debug('Error actualizando en tabla ['. $table . ']. Sentencia: [' . $query . ']. Parametros: [' . $params . '].');
                $this->logger->error('stacktrace', [$e]);
/*                 echo '<pre>';
                var_dump('ERROR:', $statement);
                die; */
            }
        }
    }

    public function delete($table, $params){

        #$query = "delete from {$table} values {$where}";
        #$values = $this->dispatcher($table);
        #$count = $this->execute($query);
    }

}

?>