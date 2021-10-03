<?php


class login extends controller
{
    function index(){
        $data['title'] = 'login';
        $data['desc'] = 'Do you already have an account?';
        $data['stylesheet'] = PATH_VIEW.'Stylesheet/master.css';
        $this->view(HEADER,$data);
        echo $this->loadHtmlTemplate('login_form.html');
        $this->view(FOOTER,$data);
    }

    function validate_login(){

        $email = '';
        $password = '';

        if (isset($_POST['email'])){
            $email = $_POST['email'];
        }
        if (isset($_POST['password'])){
            $password = $_POST['password'];
        }

        echo 'you entered:<br>'.$email.'<br>'.$password;
    }
}