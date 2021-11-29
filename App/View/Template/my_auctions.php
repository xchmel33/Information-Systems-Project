<?php
$created_display = 'none';
$history_display = (count($data['history_auctions']))?"block":"none";
$joined_display = 'none';
foreach ($data['created_auctions'] as $auction) {
    if ($auction['owner_id'] == $_SESSION['user_id'] && $auction['status'] != "finished") $created_display = 'block';
}
foreach ($data['joined_auctions'] as $ja){
    if ($ja['user_id'] == $_SESSION['user_id'] && $ja['status'] != "finished") $joined_display = "block";
}
?>
<div id="created_auctions">
    <h2 style="display: <?=$created_display?>">CREATED AUCTIONS:</h2>
    <div class="auction_wrapper">
    <?php
        foreach ($data['created_auctions'] as $auction){
            if ($auction['status'] == "finished") continue;
            if ($auction['owner_id'] != $_SESSION['user_id']) continue;
            if($auction['instant_price'] == 0){
                $required = 'required';
            }
            $instant_buy = "<input type='number' name='instant_price' value='".$auction['instant_price']."'><input type='submit' name='set_instant' value='SET INSTANT PRICE'>";

            echo '
            <div class="info">
                <img class ="pic" src="'.$auction['image'].'">
                <ul style="list-style-type: none">
                    <li><h3>'.$auction["item_name"].'</h3></li>
                    <li><h4>START PRICE: '.$auction["start_price"].' KČ</h4></li>
                    <li><h4>INSTANT PRICE: '.$auction["instant_price"].' KČ</h4></li>
                    <li><h4>MIN BID: '.$auction["min_bid"].' KČ</h4></li>
                    <li><h4>HIGHEST BID: '.$auction["highest_bid"].' KČ</h4></li>
                    <li><h4>HIGHEST BIDDER: '.$auction["highest_bidder"].'</h4></li>
                    <li><h4>STATUS: <span style="color: '.getColor($auction["status"]).'">'.$auction["status"].'</span></h4></li>
                    <li><h4>TIMELEFT: <span id="timer'.$auction["auction_id"].'"></span></h4></li>
                    <script type="text/javascript">getTimer(\''.$auction["end_time"].'\',document.getElementById("timer'.$auction["auction_id"].'"))</script>
                    ';
            if ($auction['status'] == 'created') echo 'Please wait for licidator to confirm';
            echo '<form method="post" action="my_auctions">
                        <input hidden name="auction_id" value="'.$auction["auction_id"].'">
                        <input type="submit" name="cancel" value="CANCEL AUCTION"><br>
                        '.$instant_buy.'
                    </form></ul></div>';
        }
    ?>
    </div>
</div>
<div id="joined_auctions">
    <h2 style="display: <?=$joined_display?>">JOINED AUCTIONS:</h2>
    <div class="auction_wrapper">
    <?php
        foreach ($data['joined_auctions'] as $auction){
            if ($auction['user_id'] != $_SESSION['user_id']) continue;
            if ($auction['status'] == "finished") continue;
            $auction_owner = $this->db->selectByColumnName('user','user_id',$auction['owner_id'],'username')[0]['username'];
            $auction_organizator = $this->db->selectByColumnName('user','user_id',$auction['organizator_id'],'username')[0]['username'];

            $auction_raise_size = (int)($auction['highest_bid'] == 0) ? $auction['start_price']*0.1:$auction['highest_bid']*0.1;
            $auction_bid = ($auction['user_approved'] == "1" && $auction['status'] == "started") ?
                '<input type="submit" name="instant_buy" value="BUY INSTANT"><br>
                <input type="text" hidden name="instant_price" value="'.$auction['instant_price'].'">
                 <input type="submit" name="bidM" value="BID MIN ('.$auction['min_bid'].')">
                 <input type="hidden" hidden name="bid_min" value="'.$auction['min_bid'].'">
                 <input type="hidden" hidden name="bidder" value="'.$_SESSION['username'].'">
                 <input type="number" step="'.$auction_raise_size.'" name="bidC_val" value="'.$auction['min_bid'].'">
                 <input type="submit" name="bidC" value="BID CUSTOM"><br>':'';
            $leave = ($auction['user_approved'] == 1 || $auction['user_approved'] == -1) ? "LEAVE AUCTION":"CANCEL JOIN";

            $auction_user = $this->db->selectAll(['user','auction_user'],'user_id');
            $auction_user_table = getUserTable($auction_user,$auction,false,$auction_owner,$auction_organizator);

            echo '
            <div class="info">'.$auction_user_table.'
                <img class ="pic" src="'.$auction['image'].'">
                <ul style="list-style-type: none">
                    <li><h3>'.$auction["item_name"].'</h3></li>
                    <li><h4>START PRICE: '.$auction["start_price"].' KČ</h4></li>
                    <li><h4>INSTANT PRICE: '.$auction["instant_price"].' KČ</h4></li>
                    <li><h4>HIGHEST BID: '.$auction["highest_bid"].' KČ</h4></li>                    
                    <li><h4>MIN BID: '.$auction["min_bid"].' KČ</h4></li>
                    <li><h4>HIGHEST BIDDER: '.$auction["highest_bidder"].'</h4></li>
                    <li><h4>STATUS: <span style="color: '.getColor($auction["status"]).'">'.$auction["status"].'</span></h4></li>
                    <li><h4>MY STATUS: '.getUserStatus($auction["user_approved"]).'</h4></li>
                    <li><h4>TIMELEFT: <span id="timer'.$auction["auction_id"].'"></span></h4></li>
                    <script type="text/javascript">getTimer(\''.$auction["end_time"].'\',document.getElementById("timer'.$auction["auction_id"].'"))</script>
                    <form method="post" action="my_auctions">
                        <input hidden name="auction_id" value="'.$auction["auction_id"].'">'.$auction_bid.'
                        <input name="cancel_join" type="submit" value="'.$leave.'">
                    </form>
                </ul>
            </div>';
        }
    ?>
    </div>
</div>
<div id="history_auctions">
    <h2 style="display: <?=$history_display?>">AUCTION HISTORY:</h2>
    <div class="auction_wrapper">
    <?php
        $lastID = 0;
        foreach ($data['history_auctions'] as $auction) {
            if ($auction['auction_id'] == $lastID) continue;
            if ($auction['status'] != 'finished') continue;
            $auction_organizator = $this->db->selectByColumnName('user','user_id',$auction['organizator_id'],'username')[0]['username'];
            $auction_owner = $this->db->selectByColumnName('user','user_id',$auction['owner_id'],'username')[0]['username'];
            $won = ($auction['highest_bidder'] == $_SESSION['username']) ? "WON" : "LOST";
            echo '
            <div class="info">
                <img class ="pic" src="' . $auction['image'] . '">
                <ul style="list-style-type: none">
                    <li><h3>' . $auction["item_name"] . '</h3></li>
                    <li><h4>START PRICE: ' . $auction["start_price"] . ' KČ</h4></li>
                    <li><h4>INSTANT PRICE: '.$auction["instant_price"].' KČ</h4></li>
                    <li><h4>FINAL PRICE: ' . $auction["highest_bid"] . ' KČ</h4></li>
                    <li><h4>STATUS: <span style="color: ' . getColor($auction["status"]) . '">' . $auction["status"] . '</span></h4></li>
                    <li><h4>YOU HAVE ' . $won . ' THIS AUCTION</h4></li>
                    <li><h4>AUCTION WON BY ' . $auction['highest_bidder'] . '</span></h4></li>
                    <li><h4>ORGANIZATOR: ' . $auction_organizator . '</span></h4></li>
                    <li><h4>AUCTION OWNER: ' . $auction_owner . '</span></h4></li>
                </ul>
            </div>';
        $lastID=$auction['auction_id'];
        }
    ?>
    </div>
</div>


