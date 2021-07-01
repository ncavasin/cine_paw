<?php

namespace Paw\core\database;

use PDO;
use PDOException;
use Paw\core\Config;
use Paw\core\traits\Loggable;

class ConnectionBuilder{

    use Loggable;

    private static $instance = null;
    private $connection;

    private function __construct(){
        # Do nothing
    }

    private function make(Config $config){
        try{
            $adapter =  $config->get("DB_ADAPTER");
            $hostname = $config->get("DB_HOSTNAME");
            $dbname =   $config->get("DB_DBNAME");
            $port =     $config->get("DB_PORT");
            $charset =  $config->get("DB_CHARSET");
            
            $this->connection = new PDO(
                # Connection is different because of docker presence
                # name = paw | hostname = paw_db | port = 5432 | username = admin | password = admin
                "{$adapter}:host={$hostname};dbname={$dbname};port={$port}",
                $config->get("DB_USERNAME"),
                $config->get("DB_PASSWORD"),
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)
            );

        }catch(PDOException $e){
            echo '<pre>';
            var_dump($adapter);
            var_dump($hostname);
            var_dump($dbname);
            var_dump($port);
            var_dump($charset);
            var_dump($config->get("DB_USERNAME"));
            var_dump($config->get("DB_PASSWORD"));
            $this->logger->error('Internal Server Error', ['Error' => $e]);
            die('Error Interno - Consulte al administrador');
        }
    }

    public static function getInstance(){
        if(self::$instance == null){
            # echo '[ConnectionBuilder] - Instance created';
            self::$instance = new ConnectionBuilder();
        }
        else{
            echo '[ConnectionBuilder] - Singleton applied';
        }
        return self::$instance;

    }

    public function getConnection(Config $config):PDO{
        $this->make($config);
        return $this->connection;
    }
}


?>