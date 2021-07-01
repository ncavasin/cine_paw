<?php

require __DIR__ . '/../vendor/autoload.php';

use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;
use Dotenv\Dotenv;

use Paw\core\Router;
use Paw\core\Config;
use Paw\core\Request;
use Paw\core\database\ConnectionBuilder;

# Constants
const SUCCESS = 'success';
const ERROR = 'error';
const WARN = 'warn';

# Error handler
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

# Twig
// $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/app/views/');
// $twig = new \Twig\Environment($loader, [
//     'cache' => __DIR__ . '/app/views/cache_twig/',
// ]);
// $twig->render('index_view.twig');

# Load enviroment vars
$dotenv = Dotenv::createUnsafeImmutable(__DIR__ . '/../');
$dotenv->load();

# Object to handle config file
$config = new Config();

# Use them to initialize the logger
$log = new Logger('mvc-app');
$handler = new StreamHandler($config->get('LOG_PATH'));
$handler->setLevel($config->get('LOG_LEVEL'));
$log->pushHandler($handler);

$connectionBuilder = ConnectionBuilder::getInstance();
$connectionBuilder->setLogger($log);
$connection = $connectionBuilder->getConnection($config);

# Set default timezone
date_default_timezone_set("America/Argentina/Buenos_Aires");

# Requests handler
$request = new Request();

# Routes handler
$router = new Router;
$router->setLogger($log);

# Supported routes
$router->get('/', 'PageController@index');
$router->get('/about', 'PageController@about');
$router->get('/services', 'PageController@services');

$router->get('/login', 'PageController@login');
$router->post('/login', 'UsuariosController@loginProcess');

$router->get('/reset_password', 'PageController@resetPassword');
$router->post('/reset_password', 'PageController@resetPasswordProcess');

$router->get('/register', 'PageController@register');
$router->post('/register', 'UsuariosController@register');

$router->get('/coverages', 'PageController@coverages');
$router->post('/coverages', 'PageController@coveragesProcess');

$router->get('/newturn', 'PageController@turns');
$router->get('/especialidades', 'EspecialidadesController@getEspecialidades');
$router->get('/especialistas', 'EspecialistasController@getEspecialistas');
$router->get('/turnos_disponibles', 'TurnosController@getTurnosDisponibles');
$router->post('/newturn', 'TurnosController@nuevoTurno');
$router->get('/myturns', 'TurnosController@getTurnos');
$router->get('/waiting_list', 'TurnosController@getWaitingList');

$router->get('/servicios/audiologia', 'ServicesController@audiologia');
$router->get('/servicios/cardiologia', 'ServicesController@cardiologia');
$router->get('/servicios/densitometria', 'ServicesController@densitometria');
$router->get('/servicios/ecografia_doppler', 'ServicesController@ecografiaDoppler');

# $router->get('/turns/', 'TurnsController@index');
# Add all needed routes 

?>