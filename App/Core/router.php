<?php

require 'App/functions.php';

/**
 * Main application class
 *
 * Calls controller classes by given url from client;
 * where the url was rewritten by the .htaccess rewrite engine
 * and stored in $_GET['url'] variable
 *
 * @autor Lukas Chmelo, xchmel33
 *
 * @var string $controller controller class to be called
 * @var string $method optional method of controller class
 * @var array $params optional parameters to be passed into method of controller class
 *
 */

class router
{
    protected $controller = 'error';
    protected $method = 'index';
    protected $params = [];


    /**
     * Router constructor
     *
     * Searches for existing classes and methods inside controller
     * by output from url parser and if found, calls them,
     * otherwise calls default class or method
     *
     */
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

    /**
     * Url parser
     *
     * Parses url into strings representing controller class name,
     * controller class method and method's parameters
     *
     * @return string[]
     */
    private function parseURL(){
        if (isset($_GET['url'])){
            return explode("/", trim($_GET['url'],'/'));
        }
        else{
            return ['home'];
        }
    }
}