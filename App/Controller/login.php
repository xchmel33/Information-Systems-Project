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
        $country = '';
        $city = '';

        if (isset($_POST['username'])){
            $username = $_POST['username'];
        }
        if (isset($_POST['email'])){
            $email = $_POST['email'];
        }
        if (isset($_POST['password'])) {
            $password = $_POST['password'];
        }
        if (isset($_POST['country'])){
            $country = $_POST['country'];
        }
        if (isset($_POST['city'])){
            $city = $_POST['city'];
        }

        // check if email exist
        if ($this->db->selectByColumnName('user','email',$email) != []){
            echo 'User with email \''.$email.'\' already exist!';
            return;
        }

        // check if username exits
        if($this->db->selectByColumnName('user','username',$username) != []){
            echo 'User with username \''.$username.'\' already exist!';
            return;
        }

        // insert
        $column_names = ['username','password','email','country','city'];
        $column_values = [$username,$password,$email,$country,$city];
        $this->db->insert('user',$column_names,$column_values);
        echo '1'.$username;
    }


    function validate_login(){

        if(!isset($_POST['email']) || !isset($_POST['password'])){
            echo 'At least one field is empty!';
            return;
        }
        $query = $this->db->selectByColumnName('user','email',$_POST['email']);
//        var_dump($query);
        if ($query == []){
            echo 'User with email '.$_POST['email'].' does not exist!';
        }
        else if($_POST['password'] == $query[0]['password']){
            echo '1'.$query[0]['username'];
        }
        else{
            echo 'Invalid password!';
        }
    }
}
