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

    function validate_register(){
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


    function validate_login(){

        if(!isset($_POST['email']) || !isset($_POST['password'])){
            echo 'At least one field is empty!';
            return;
        }
        $query = $this->db->selectByRowName('user','email',$_POST['email']);
        var_dump($query);
        if ($query == []){
            echo 'user with email: '.$_POST['email'].' does not exist!';
        }
        else if($_POST['password'] == $query[0][2]){
            echo 'login successful!';
        }
        else{
            echo 'Invalid password!';
        }
    }
}
