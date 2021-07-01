<?php

namespace Paw\core;

use Exception;
use Paw\core\exceptions\RouteNotFoundException;
use Paw\core\Request;
use Paw\core\traits\Loggable;

class Router {

    # Add logging abilities
    use Loggable;

    public array $routes = [
        "GET" => [],
        "POST" => []
    ];

    public string $notFound = 'not_found';
    public string $internalError = 'internal_error';

    public function __construct(){
    
        $this->get($this->notFound, 'ErrorController@notFound');
        $this->get($this->internalError, 'ErrorController@internalError');

    }

    # Add an action method for the <route's_path+http_method> received pair
    private function loadRoute($path, $action, $http_method = "GET"){
        $this->routes[$http_method][$path] = $action;
    }


    # Load a route with http_method as GET
    public function get($path, $action){
        $this->loadRoute($path, $action, "GET");
    }

    # Load a route with http_method as POST
    public function post($path, $action){
        $this->loadRoute($path, $action, "POST");
    }

    # Check path existance for the http method received
    public function exists($path, $http_method){
        return array_key_exists($path, $this->routes[$http_method]);
    }


    # Return proper controller for http method received
    public function getController($path, $http_method){

        if (! $this->exists($path, $http_method)){
            throw new RouteNotFoundException('No existe una ruta para este path');
        }

        return explode('@', $this->routes[$http_method][$path]);
    }     


    public function call($controller, $method){
        $this->logger->info($controller);
        $controller_name = "Paw\\app\\controllers\\{$controller}";
            
        # Serve it properly
        $objController = new $controller_name;
        $objController->$method();
        
    }

    # Trigger action method based upon the http method received
    public function direct(Request $request){

        try{

            # Get path + http_method received
            list($path, $http_method) = $request->route();

            # Parse request into controller and method handler
            list($controller, $method)  = $this->getController($path, $http_method);
            
            # Log the call properly
            $this->logger->info(
                "Status Code: 200",
                [
                    "Path" => $path,
                    "Method" => $http_method 
                ]
            );

        } catch(RouteNotFoundException $e){

            list($controller, $method)  = $this->getController($this->notFound, "GET");
            $this->logger->debug("Status Code: 404 - Route Not Found", ["ERROR" => $e]);

        } catch(Exception $e2){
            
            list($controller, $method)  = $this->getController($this->internalError, "GET");
            $this->logger->error("Status Code: 500 - Internal Server Error", ["ERROR" => $e2]);

        }finally{

            # Act according previous situations
            $this->call($controller, $method);
        }
    }
 
}

?>