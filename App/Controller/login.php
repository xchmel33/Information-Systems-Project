<?php
// Stylesheet/master.css

class login extends controller
{
    function index(){
        $data['title'] = 'login';
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
}?>
