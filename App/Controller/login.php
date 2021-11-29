<?php
// Stylesheet/master.css

class login extends controller
{
    function index(){
        $data['title'] = get_class($this);
        $this->view(HEADER,$data);

        //check if user not already logged in
        if (isset($_SESSION['username']) && $_SESSION['valid']){
            $error = 'Already logged in as '.$_SESSION['username'].'!';
            echo '<h1>'.$error.'</h1>';
        }
        else{
            echo $this->loadHtmlTemplate('login_form.html');
        }
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
        $column_names = ['username','password','email','country','city','user_role'];
        $column_values = [$username,$password,$email,$country,$city,'reg_user'];
        $this->db->insert('user',$column_names,$column_values);
        echo '1'.$username;
        $user_id = $this->db->getAutoIncrement('user')-1;
        $this->start_login_session($username,'reg_user',$user_id);
    }


    function validate_login(){

        if(!isset($_POST['email']) || !isset($_POST['password'])){
            echo 'At least one field is empty!';
            return;
        }
        $query = $this->db->selectByColumnName('user','email',$_POST['email']);
        if ($query == []){
            $query = $this->db->selectByColumnName('user','username',$_POST['email']);
        }
        if($query != [] && $_POST['password'] == $query[0]['password']){
            echo '1'.$query[0]['username'];
            $this->start_login_session($query[0]['username'],$query[0]['user_role'],$query[0]['user_id']);
        }
        else{
            echo 'Invalid username or password!';
        }
    }

    protected function start_login_session($username,$user_role,$user_id){
        session_abort();
        session_start();
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['username'] = $username;
        $_SESSION['user_role'] = $user_role;
        $_SESSION['user_id'] = $user_id;
    }

    function logout(){
        session_abort();
        session_start();
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        unset($_SESSION['user_role']);
        unset($_SESSION['user_id']);
        unset($_SESSION['timeout']);
        $_SESSION['valid'] = false;
    }
}
