<?

namespace Paw\core;

class Config{

    private array $configs;

    public function __construct(){
        $this->configs['LOG_LEVEL'] = getenv('LOG_LEVEL', 'INFO');
        $path = getenv('LOG_PATH', '/logs/app.log');
        $this->configs['LOG_PATH'] = $this->joinPaths('..', $path);


        $this->configs['DB_ADAPTER'] = getenv("DB_ADAPTER") ?? 'postgresql';
        $this->configs['DB_HOSTNAME'] = getenv("DB_HOSTNAME") ?? 'localhost';
        $this->configs['DB_DBNAME'] = getenv("DB_DBNAME") ?? 'database_name';
        $this->configs['DB_USERNAME'] = getenv("DB_USERNAME") ?? 'postgres';
        $this->configs['DB_PASSWORD'] = getenv("DB_PASSWORD") ?? 'postgres';
        $this->configs['DB_PORT'] = getenv("DB_INTERNAL_PORT") ?? '5432';
        $this->configs['DB_CHARSET'] = getenv("DB_CHARSET") ?? 'utf8';

        // $this->configs['PGADMIN_DEFAULT_EMAIL'] = getenv('PGADMIN_DEFAULT_EMAIL') ?? 'admin@admin';
        // $this->configs['PGADMIN_DEFAULT_PASSWORD'] = getenv('PGADMIN_DEFAULT_PASSWORD') ?? 'root';
        // $this->configs['PGADMIN_PORT'] = getenv('PGADMIN_PORT') ?? '5050';
    }

    function joinPaths() {
        $paths = array();

        foreach (func_get_args() as $arg) {
            if($arg != ''){
                $paths[] = $arg;
            }
        }
    
        return  preg_replace('#/+#', '/', join('/', $paths));
    }

    public function get($name){
        return $this->configs[$name] ?? null;
    }

}

?>