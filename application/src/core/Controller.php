<?php

namespace Paw\core;

use Paw\core\database\QueryBuilder;
use Paw\core\Model;
use Paw\core\Session;

class Controller {

    # 1-1 relation against a model
    public ?string $modelName = null;
    
    protected string $viewsDir;
    protected array $contact;
    protected array $userOptions;
    protected array $menuOptions;
    protected array $footerLinks;
    protected Session $session;

    public function __construct(){
        global $connection, $log;
        $this->viewsDir = __DIR__ . "/../app/views/";
        $this->userOptions = [
            [
                'href' => '/login',
                'name' => 'Ingresar'
            ],
            [
                'href' => '/register',
                'name' => 'Registrarse'
            ]
        ];
        $this->menuOptions = [
            [
                'href' => '/about',
                'name' => 'Nosotros'
            ],
            [
                'href' => '/services',
                'name' => 'Cartelera'
            ],
            [
                'href' => '/coverages',
                'name' => 'Buscar'
            ],
            [
                'href' => '/myturns',
                'name' => 'Próximamente'
            ]
        ];
        $this->footerLinks = [
            [
                'href' => 'https://www.facebook.com/dentalmedicalgroup',
                'name' => 'facebook'
            ],
            [
                'href' => 'https://www.instagram.com/dentalmedicalgroup',
                'name' => 'instagram'
            ],
            // [
            //     'href' => 'https://www.linkedin.com/dentalmedicalgroup',
            //     'name' => 'linkedin'
            // ],
            [
                'href' => 'mailto:contacto@dentalmedicalgroup.com',
                'name' => 'mail'
            ]
        ];
        if(! is_null($this->modelName)){
            
            # Construct QB
            # var_dump($connection);die;
            $qb = new QueryBuilder($connection, $log);

            # Construct Model dynamically
            $model = new $this->modelName;

            # Inject QB to Model
            $model->setQueryBuilder($qb);
            $this->setModel($model);
        }
        $this->session = new Session();
    }

    private function setModel(Model $model){
        $this->model = $model; 
    }
}

?>