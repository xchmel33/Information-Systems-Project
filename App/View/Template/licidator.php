<div id="licidator_page">
    <h2>APPROVE CREATED AUCTIONS:</h2>
    <?php
        foreach ($data['auctions'] as $auction){
            $auction_owner = $this->db->selectByColumnName('user','user_id',$auction['owner_id'],'username')[0]['username'];
            if ($auction['status'] != 'created') continue;
            echo '
            <div class="info">
                <img class ="pic" src="'.$auction['image'].'">
                <ul style="list-style-type: none">
                    <li><h3>'.$auction["item_name"].'</h3></li>
                    <li><h4>START PRICE: '.$auction["start_price"].' KČ</h4></li>
                    <li><h4>OWNER: '.$auction_owner.'</h4></li>
                    <li><h4>STATUS: <span style="color: '.getColor($auction["status"]).'">'.$auction["status"].'</span></h4></li>
                    <li><h4>TIMELEFT: <span id="timer'.$auction["auction_id"].'"></span></h4></li>
                    <script type="text/javascript">getTimer(\''.$auction["end_time"].'\',document.getElementById("timer'.$auction["auction_id"].'"))</script>
                    <form method="post" action="licidator">
                        <input hidden name="auction_id" value="'.$auction["auction_id"].'">
                        <input name="approve" type="submit" value="APPROVE">
                        <input name="disapprove" type="submit" value="DISAPPROVE">
                    </form>
                </ul>
            </div>';
        }
    ?>
</div>
<div id="licidator_page">
    <h2>ORGANIZE AUCTIONS:</h2>
    <?php
    foreach ($data['auctions'] as $auction){
        $auction_owner = $this->db->selectByColumnName('user','user_id',$auction['owner_id'],'username')[0]['username'];
        if ($auction['organizator_id'] != $_SESSION['user_id']) continue;
        $auction_raise_size = $auction['highest_bid']*0.1;
        $auction_user = $this->db->selectAll(['user','auction_user'],'user_id');
        echo '
            <div class="info"><div class="user_join_wrapper"><h4>USERS WANTING TO JOIN:</h4><form method="post" action="licidator" class="users_join">';
        foreach ($auction_user as $au_user){
            if ($au_user['user_approved'] != 0 || $au_user['auction_id'] != $auction['auction_id']) continue;
            echo '
                <label>'.$au_user['username'].'</label>
                <input hidden name="auction_id" value="'.$auction["auction_id"].'">
                <input type="submit" name="confirm" value="confirm join">
                <input type="submit" name="reject" value="reject join">
                ';
        }
        echo '</form></div>
                <img class ="pic" src="'.$auction['image'].'">
                <ul style="list-style-type: none">
                    <li><h3>'.$auction["item_name"].'</h3></li>
                    <li><h4>START PRICE: '.$auction["start_price"].' KČ</h4></li>
                    <li><h4>OWNER: '.$auction_owner.'</h4></li>
                    <li><h4>STATUS: <span style="color: '.getColor($auction["status"]).'">'.$auction["status"].'</span></h4></li>
                    <li><h4>TIMELEFT: <span id="timer'.$auction["auction_id"].'"></span></h4></li>
                    <script type="text/javascript">getTimer(\''.$auction["end_time"].'\',document.getElementById("timer'.$auction["auction_id"].'"))</script>
                    <form method="post" action="licidator">
                        <input hidden name="auction_id" value="'.$auction["auction_id"].'">
                        <input type="number" size="'.$auction_raise_size.'" name="bidC_val" value="'.$auction_raise_size.'">
                        <input type="submit" name="bidR" value="SET MIN REQUIRED BID"><br>
                        <input name="setDate" type="date" value="'.explode(' ',$auction['end_time'])[0].'">
                        <input name="setTime" type="time" value="'.explode(' ',$auction['end_time'])[1].'">
                        <input type="submit" name="setT" value="SET TIMELEFT"><br>
                    </form>
                </ul>
            </div>';
    }
    ?>

</div>

