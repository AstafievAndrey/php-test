<?php

class App {

    protected $config;

    public function __construct($config) {
        $this->config = $config;
    }

    public function loadController(array $route = null) {
        if(!is_null($route)) {
            $controllerName = ucfirst($route[0]).'Controller';
            if(file_exists(PATH_CONTROLLERS . $controllerName . '.php')) {  
                require_once PATH_CONTROLLERS . $controllerName . '.php';
                $controller = new $controllerName();
                $action = isset($route[1]) ? 'action'.$route[1] : 'actionIndex';
                $res = (method_exists($controller, $action)) ? $controller->$action() : ['errors/404', []];
                if (!isset($res['type'])) {
                    $res['type'] = 'text/html';
                }
                return $res;
            } 
        }
        return null;
    }

    public function loadDefault() {
        $res = $this->loadController(['site']);
        $this->loadView($res[0], $res[1]);
    }

    public function loadJson($data){
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function loadView($view, array $data) {
        foreach($data as $key => $value) {
            $$key = $value;
        }
        $loadView = $view . '.php';
        require PATH_VIEWS . 'layouts/main.php';
    }
}