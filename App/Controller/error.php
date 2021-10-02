<?php


class error extends controller
{
    function index(){
        $this->loadHtmlTemplate('error_page.html');
    }
}