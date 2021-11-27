<?php


class admin extends controller
{
    public function index(){

        // get index of form submitted
        $i = isset($_POST['user_i']) ? $_POST['user_i']:-1;

        // deleted user
        if(isset($_POST['delete']) && $_POST['delete'] != ''){
            $this->db->deleteRecord('user','user_id',$_POST['delete']);
        }

        // make changes to user
        $data['edit_result'] = true;
        if ($i != -1){
            $column_names = ['username','email','password','user_role','city','country'];
            $column_values = [$_POST['username'],$_POST['email'],$_POST['password'],$_POST['user_role'],$_POST['city'],$_POST['country']];
            $data['edit_result'] = $this->db->update('user',$column_names,$column_values,'user_id',$_POST['user_id']);
        }

        $data['title'] = 'admin';
        $data['user_array'] =  $this->db->selectAll('user');
        $this->view(HEADER,$data);
        $this->view('admin.php',$data);
        $this->view(FOOTER,$data);

    }
}