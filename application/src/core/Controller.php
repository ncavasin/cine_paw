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
    protected bool $logged;
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
                'href' => '/now_playing',
                'name' => 'Cartelera'
            ],
            [
                'href' => '/coming_soon',
                'name' => 'Próximamente'
            ]
        ];

        $this->footerLinks = [
            [
                'href' => 'https://www.facebook.com/cine_paw',
                'name' => 'facebook'
            ],
            [
                'href' => 'https://www.instagram.com/cine_paw',
                'name' => 'instagram'
            ],
            [
                'href' => 'mailto:contacto@cinepaw.com',
                'name' => 'mail'
            ]
        ];

        $this->logged = boolval($_SESSION['userId']);

        if($this->logged){
            $this->userOptions = [
                [
                    'href' => '/my_account',
                    'name' => 'Mi cuenta',
                ],
                [
                    'href' => '/logout',
                    'name' => 'Salir'
                ],
            ];
                
        }

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