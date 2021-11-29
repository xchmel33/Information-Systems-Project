<?php


class licidator extends controller
{
    public function index(){
        //authentication
        if($_SESSION['user_role'] != 'licidator' && $_SESSION['user_role'] != 'admin'){
            header("Location:error");
        }

        // user
        if (isset($_POST['approve'])){
            $this->db->update('auction',['organizator_id','status'],[$_SESSION['user_id'],'started'],'auction_id',$_POST['auction_id']);
        }
        if (isset($_POST['disapprove'])){
            $this->db->update('auction',['organizator_id','status'],[-1,'disapproved'],'auction_id',$_POST['auction_id']);
        }
        if (isset($_POST['kick'])){
            $this->db->deleteRecord('auction_user','user_id',$_POST['kick_id']);
        }

        // auction
        if (isset($_POST['setT'])){
            $timeleft = DateTime::createFromFormat('Y-m-d H:i:s',$_POST["setDate"] . ' ' . $_POST["setTime"]);
            $this->db->update('auction',['end_time'],[$timeleft->format("Y-m-d H:i:s")],'auction_id',$_POST['auction_id']);
        }
        if (isset($_POST['bidR'])){
            $this->db->update('auction',['min_bid'],[$_POST['bidC_val']],'auction_id',$_POST['auction_id']);
        }
        if (isset($_POST['delete'])){
            $this->db->deleteRecord('auction','auction_id',$_POST['auction_id']);
        }
        if (isset($_POST['PAUSE'])){
            $this->db->update('auction',['status'],['paused'],'auction_id',$_POST['auction_id']);
        }if (isset($_POST['RESUME'])){
            $this->db->update('auction',['status'],['started'],'auction_id',$_POST['auction_id']);
        }
        if (isset($_POST['finish'])){
            $this->db->update('auction',['status','winner'],['finished',$_POST['highest_bidder']],'auction_id',$_POST['auction_id']);
        }
        $data['title'] = 'licidator';
        $data['auctions'] = $this->db->selectAll('auction');
        $this->view(HEADER,$data);
        $this->view('licidator.php',$data);
        $this->view(FOOTER);
    }
    public function auction_user_table(){
        if (isset($_POST['confirm'])){
            $this->db->update('auction_user',['user_approved'],[1],'user_id',$_POST['user_id']);
        }
        if (isset($_POST['reject'])){
            $this->db->update('auction_user',['user_approved'],[-1],'auction_id',$_POST['auction_id']);
        }
        header("Location:../licidator");
    }
}