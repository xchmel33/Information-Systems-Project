<?php


class create_auction extends controller
{
    function index(){
        $data['title'] = 'create_auction';
        $this->view(HEADER,$data);
        $this->view(FOOTER);
    }
}