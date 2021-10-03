<?php


class home extends controller
{
    function index(){
        $data['title'] = 'home';
        $data['stylesheet'] = PATH_VIEW.'Stylesheet/master.css';
        $this->view(HEADER,$data);
        echo $this->loadHtmlTemplate('home_page.html');
        $this->view(FOOTER,$data);
    }
}