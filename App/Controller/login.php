<?php


class login extends controller
{
    function index(){
        $data['title'] = 'login';
        $this->view('Template/header.php',$data);
        echo $this->loadHtmlTemplate('login_form.html');
        $this->view('error.php',$data);
        $this->view('Template/footer.php',$data);
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