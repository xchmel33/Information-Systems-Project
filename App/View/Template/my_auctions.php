<div id="created_auctions">
    <h2>CREATED AUCTIONS:</h2>
    <?php
        foreach ($data['created_auctions'] as $auction){
            if ($auction['owner_id'] != $_SESSION['user_id']) continue;
            echo '
            <div class="info">
                <img class ="pic" src="'.$auction['image'].'">
                <ul style="list-style-type: none">
                    <li><h3>'.$auction["item_name"].'</h3></li>
                    <li><h4>START PRICE: '.$auction["start_price"].' KČ</h4></li>
                    <li><h4>HIGHEST BID: '.$auction["highest_bid"].' KČ</h4></li>
                    <li><h4>STATUS: <span style="color: '.getColor($auction["status"]).'">'.$auction["status"].'</span></h4></li>
                    <li><h4>TIMELEFT: <span id="timer'.$auction["auction_id"].'"></span></h4></li>
                    <script type="text/javascript">getTimer(\''.$auction["end_time"].'\',document.getElementById("timer'.$auction["auction_id"].'"))</script>
                    ';
            if ($auction['status'] == 'created') echo 'Please wait for licidator to confirm';
            echo '<form method="post" action="my_auctions">
                        <input hidden name="auction_id" value="'.$auction["auction_id"].'">
                        <input type="submit" value="CANCEL AUCTION">
                    </form></ul></div>';
        }
    ?>
</div>
<div id="joined_auctions">
    <h2>JOINED AUCTIONS:</h2>
    <?php
        foreach ($data['joined_auctions'] as $auction){
            if ($auction['user_id'] != $_SESSION['user_id'] || !$auction['user_approved']) continue;
            $auction_raise_size = $auction['highest_bid']*0.1;
            echo '
            <div class="info">
                <img class ="pic" src="'.$auction['image'].'">
                <ul style="list-style-type: none">
                    <li><h3>'.$auction["item_name"].'</h3></li>
                    <li><h4>START PRICE: '.$auction["start_price"].' KČ</h4></li>
                    <li><h4>HIGHEST BID: '.$auction["highest_bid"].' KČ</h4></li>
                    <li><h4>STATUS: <span style="color: '.getColor($auction["status"]).'">'.$auction["status"].'</span></h4></li>
                    <li><h4>TIMELEFT: <span id="timer'.$auction["auction_id"].'"></span></h4></li>
                    <script type="text/javascript">getTimer(\''.$auction["end_time"].'\',document.getElementById("timer'.$auction["auction_id"].'"))</script>
                    <form method="post" action="my_auctions">
                        <input hidden name="auction_id" value="'.$auction["auction_id"].'">
                        <input type="submit" name="bidR" value="BID REQUIRED">
                        <input type="number" size="'.$auction_raise_size.'" name="bidC_val" value="'.$auction_raise_size.'">
                        <input type="submit" name="bidC" value="BID CUSTOM">
                    </form>
                </ul>
            </div>';
        }
    ?>
</div>