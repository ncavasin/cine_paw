<?

namespace Paw\core;

# To handle requests uniformly
class Request{
 
    public function __construct()
    {
        
    }

    public function uri(){
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    public function method(){
        return $_SERVER['REQUEST_METHOD'];
    }

    public function route(){
        return[
            $this->uri(),
            $this->method()
        ];
    }
}


?>