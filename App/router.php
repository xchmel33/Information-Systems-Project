<?php

require 'App/functions.php';

class router
{
    protected $controller = 'error';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();


        if (file_exists(PATH_CONTROLLER.strtolower($url[0]).'.php')) {
            $this->controller = strtolower($url[0]);
            unset($url[0]);
        }
        require PATH_CONTROLLER.$this->controller.'.php';
        $this->controller = new $this->controller;

        if(isset($url[1])){
            if(method_exists($this->controller,strtolower($url[1]))){
                $this->method = strtolower($url[1]);
                unset($url[1]);
            }
        }

        $this->params = array_values($url);
        call_user_func_array([$this->controller,$this->method],$this->params);
    }

    private function parseURL(){
        if (isset($_GET['url'])){
            return explode("/", trim($_GET['url'],'/'));
        }
        else{
            return ['home'];
        }
    }
}