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

    function register(){
        $email = '';
        $password = '';
        $username = '';
        $address = '';

        if (isset($_POST['username'])){
            $username = $_POST['username'];
        }
        if (isset($_POST['email'])){
            $email = $_POST['email'];
        }
        if (isset($_POST['password'])) {
            $password = $_POST['password'];
        }
        if (isset($_POST['address'])){
            $address = $_POST['address'];
        }
        $column_names = ['username','password','email','address'];
        $column_values = [$username,$password,$email,$address];

        if($this->db->insert('user',$column_names,$column_values) == 1){
            echo 'successfully registered!';
        }
        else{
            echo 'registration failed!';
        }
    }


    function validate(){

        $email = '';
        $password = '';

        if (isset($_POST['email'])){
            $email = $_POST['email'];
        }
        if (isset($_POST['password'])){
            $password = $_POST['password'];
        }

        $query = $this->db->selectByX('user','email',$email);
        var_dump($query);
        if ($query == []){
            echo 'user with email: '.$email.' does not exist!';
        }
        else if($password == $query[0][2]){
            echo 'login successful!';
        }
        else{
            echo 'Invalid password!';
        }
    }
}
