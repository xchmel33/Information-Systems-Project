<?php

/**
 * Class controller
 *
 * Holds shared functions and is extended by other classes inside Controller directory
 */
class controller
{
    /**
     * @var database
     */
    protected $db;
    protected $model;

    /**
     * Initialize database
     */
    public function __construct(){
        $this->db = new database();
    }

    /**
     * Html template loader
     *
     * Enables to load html file from App/View/Template
     * and returns raw html code
     *
     * @param $template
     * @return string
     */
    protected function loadHtmlTemplate($template){

        if (file_exists(PATH_TEMPLATE.$template)){
            return file_get_contents(PATH_TEMPLATE.$template);
        }
        else{
            return file_get_contents(PATH_TEMPLATE.'error_page.html');
        }
    }

    /**
     * Php file view
     *
     * Enables to load php file from App/View
     * and includes it in the document
     *
     * @param $view
     * @param array $data
     */
    protected function view($view, $data = []){
        if(file_exists(PATH_TEMPLATE.$view)) {
            include PATH_TEMPLATE.$view;
        }
    }

    /**
     * Model loader VIP
     *
     * Loads model files
     *
     * @param $model
     * @return false|mixed
     */
    protected function loadModel($model){

        $model = $model.'php';
        if (file_exists(PATH_MODEL.$model)){
            require PATH_MODEL.$model;
            $this->model = $model;
        }
        else{
            return false;
        }
    }
}