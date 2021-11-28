<?php


class my_auctions extends controller
{
    public function index(){
        if (isset($_POST['cancel'])){
            $this->db->deleteRecord('auction','auction_id',$_POST['auction_id']);
        }
        if (isset($_POST['cancel_join'])){
            $this->db->deleteRecord('auction_user','user_id',$_SESSION['user_id']);
        }
        if (isset($_POST['bidC'])){
            $this->db->update('auction_user',['user_bid'],[$_POST['bidC_val']],'user_id',$_SESSION['user_id']);
        }
        if (isset($_POST['bidM'])){
            $this->db->update('auction_user',['user_bid'],[$_POST['bid_min']],'user_id',$_SESSION['user_id']);
        }
        $this->loadModel('auction_user_table');

        $data['title'] = 'my_auctions';
        $data['stylesheet'] = PATH_STYLESHEET.'master.css';
        $data['created_auctions'] = $this->db->selectAll('auction');
        $data['joined_auctions'] = $this->db->selectAll(['auction_user','auction'],'auction_id');
        $this->view(HEADER,$data);
        $this->view('my_auctions.php',$data);
        $this->view(FOOTER);
    }
}