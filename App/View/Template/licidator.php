<?php

$approved_display = 'none';
$organize_display = 'none';
foreach ($data['auctions'] as $auction) {
    if ($auction['status'] == 'created') $approved_display = 'block';
    if ($auction['organizator_id'] == $_SESSION['user_id'] && $auction['status'] == 'started') $organize_display = 'block';
}
?>
<div id="licidator_page">
    <h2 style="display: <?=$approved_display?>">APPROVE CREATED AUCTIONS:</h2>
    <div class="auction_wrapper">
    <?php
        foreach ($data['auctions'] as $auction){
            if ($auction['status'] == "finished") continue;
            $auction_owner = $this->db->selectByColumnName('user','user_id',$auction['owner_id'],'username')[0]['username'];
            $auction_raise_size = (int) $auction['start_price']*0.1;
            $min_bid = ($auction['min_bid'] == 0) ? ($auction['start_price']+$auction_raise_size):$auction['min_bid'];
            if ($auction['status'] != 'created') continue;
            echo '
            <div class="info">
                <img class ="pic" src="'.$auction['image'].'">
                <ul style="list-style-type: none !important;" class="auction_ul">
                    <li><h3>'.$auction["item_name"].'</h3></li>
                    <li><p>'.$auction["auction_description"].'</p></li>
                    <li><h4>START PRICE: '.$auction["start_price"].' KČ</h4></li>
                    <li><h4>INSTANT PRICE: '.$auction["instant_price"].' KČ</h4></li>
                    <li><h4>MIN BID: '.$min_bid.' KČ</h4></li>
                    <li><h4>OWNER: '.$auction_owner.'</h4></li>
                    <li><h4>STATUS: <span style="color: '.getColor($auction["status"]).'">'.$auction["status"].'</span></h4></li>
                    <li><h4>TIMELEFT: <span id="timer'.$auction["auction_id"].'"></span></h4></li>
                    <script type="text/javascript">getTimer(\''.$auction["end_time"].'\',document.getElementById("timer'.$auction["auction_id"].'"))</script>
                    <form method="post" action="licidator">
                        <input hidden name="auction_id" value="'.$auction["auction_id"].'">
                        <input type="number" step="'.$auction_raise_size.'" name="bidC_val" value="'.$min_bid.'">
                        <input type="submit" name="bidR" value="SET MIN BID"><br>
                        <input name="approve" type="submit" value="APPROVE">
                        <input name="disapprove" type="submit" value="DISAPPROVE">
                    </form>
                </ul>
            </div>';
        }
    ?>
    </div>
</div>
<div id="licidator_page">
    <h2 style="display: <?=$organize_display?>">ORGANIZE AUCTIONS:</h2>
    <div class="auction_wrapper">
    <?php
    foreach ($data['auctions'] as $auction){
        if ($auction['status'] == "finished") continue;
        $auction_owner = $this->db->selectByColumnName('user','user_id',$auction['owner_id'],'username')[0]['username'];
        $auction_organizator = $this->db->selectByColumnName('user','user_id',$_SESSION['user_id'],'username')[0]['username'];
        if ($auction['organizator_id'] != $_SESSION['user_id']) continue;
        $auction_raise_size = (int)($auction['highest_bid'] == 0) ? $auction['start_price']*0.1:$auction['highest_bid']*0.1;
        $auction_user = $this->db->selectAll(['user','auction_user'],'user_id');
        $auction_paused = ($auction['status'] == "paused") ? "RESUME":"PAUSE";
        $instant_buy = "<input type='number' name='instant_price' value='".$auction['instant_price']."'><input type='submit' name='set_instant' value='SET INSTANT PRICE'><br>";


        // user join form
        $user_table = getUserTable($auction_user,$auction,true,$auction_owner,$auction_organizator);
        echo '
            <div class="info">'.$user_table.'
                <img class ="pic" src="'.$auction['image'].'">
                <ul style="list-style-type: none">
                    <li><h3>'.$auction["item_name"].'</h3></li>
                    <li><p>'.$auction["auction_description"].'</p></li>
                    <li><h4>START PRICE: '.$auction["start_price"].' KČ</h4></li>
                    <li><h4>INSTANT PRICE: '.$auction["instant_price"].' KČ</h4></li>
                    <li><h4>MIN BID: '.$auction["min_bid"].' KČ</h4></li>
                    <li><h4>HIGHEST BID: '.$auction["highest_bid"].' KČ</h4></li>
                    <li><h4>HIGHEST BIDDER: '.$auction["highest_bidder"].'</h4></li>
                    <li><h4>OWNER: '.$auction_owner.'</h4></li>
                    <li><h4>STATUS: <span style="color: '.getColor($auction["status"]).'">'.$auction["status"].'</span></h4></li>
                    <li><h4>TIMELEFT: <span id="timer'.$auction["auction_id"].'"></span></h4></li>
                    <script type="text/javascript">getTimer(\''.$auction["end_time"].'\',document.getElementById("timer'.$auction["auction_id"].'"))</script>
                    <form method="post" action="licidator">
                        <input hidden name="auction_id" value="'.$auction["auction_id"].'">
                        <input type="number" step="'.(int)$auction_raise_size.'" name="bidC_val" value="'.$auction['min_bid'].'">
                        <input type="submit" name="bidR" value="SET MIN BID"><br>'.$instant_buy.'
                        <input name="setDate" type="date" value="'.explode(' ',$auction['end_time'])[0].'">
                        <input name="setTime" type="time" value="'.explode(' ',$auction['end_time'])[1].'">
                        <input type="submit" name="setT" value="SET TIMELEFT"><br>
                        <input type="submit" onclick="confirm(\'Delete auction '.$auction['auction_id'].'\')" name="delete" value="DELETE AUCTION"><br>
                        <input type="submit" name="'.$auction_paused.'" value="'.$auction_paused.' AUCTION"><br>
                        <input type="submit" name="finish" value="FINISH AUCTION"><br>
                        <input name="highest_bidder" value="'.$auction['highest_bidder'].'" hidden>
                    </form>
                </ul>
            </div>';
    }
    ?>
    </div>
</div>

