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
        if (isset($_POST['set_instant'])){
            $this->db->update('auction',['instant_price'],[$_POST['instant_price']],'auction_id',$_POST['auction_id']);
        }
        if (isset($_POST['buy_instant'])){
            $this->db->update('auction_user',['user_bid'],[$_POST['instant_price']],'auction_id',$_POST['auction_id']);
        }


        $data['title'] = 'my_auctions';
        $data['stylesheet'] = PATH_STYLESHEET.'master.css';
        $data['created_auctions'] = $this->db->selectAll('auction');
        $data['joined_auctions'] = $this->db->selectAll(['auction_user','auction'],'auction_id');
        $i=0;
        $data['history_auctions'] = [];
        foreach ($data['joined_auctions'] as $auction) {
            $i++;
            if ($auction['status'] == "finished" && $auction['user_id'] == $_SESSION['user_id'] || $auction['organizator_id'] == $_SESSION['user_id'] || $auction['owner_id'] == $_SESSION['user_id'])
                $data['history_auctions'][$i] = $auction;
        }
        $this->view(HEADER,$data);
        $this->view('my_auctions.php',$data);
        $this->view(FOOTER);
    }

}