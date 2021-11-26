<?php


class siteError extends controller
{
    function index(){
        $data['title'] = ' 404 ';
        $data['stylesheet'] = PATH_VIEW.'Stylesheet/master.css';
        $this->view(HEADER,$data);
        echo '<style>#header{display: none}</style>';
        $this->view('error.php',$data);
        $this->view(FOOTER,$data);
    }
}