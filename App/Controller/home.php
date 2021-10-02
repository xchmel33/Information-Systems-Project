<?php


class home extends controller
{
    function index(){
        $data['title'] = 'home';
        $this->view('Template/header.php',$data);
        $this->view('Template/footer.php',$data);
    }
}