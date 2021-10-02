<?php


class controller
{
    protected function loadHtmlTemplate($template){

        if (file_exists(PATH_TEMPLATE.$template)){
            return file_get_contents(PATH_TEMPLATE.$template);
        }
        else{
            return file_get_contents(PATH_TEMPLATE.'error_page.html');
        }
    }
    
    protected function view($view, $data = []){
        if(file_exists(PATH_VIEW.$view)) {
            include PATH_VIEW.$view;
        }
    }

    protected function loadModel($model){

        $model = $model.'php';
        if (file_exists(PATH_MODEL.$model)){
            include PATH_MODEL.$model;
            return $model();
        }
        else{
            return false;
        }
    }
}