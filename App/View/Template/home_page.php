<div id="home">
    <section id="current-auctions">
            <h1>CURRENT AUCTIONS</h1>
        <?php
        foreach ($data['auction_array'] as $auction){
            if ($auction['status'] != 'approved') continue;
            echo '
            <div class="info">
                <img class ="pic" src="'.$auction['image'].'">
                <ul style="list-style-type: none">
                    <li><h3>'.$auction["item_name"].'</h3></li>
                    <li><h4>START PRICE: '.$auction["start_price"].' KČ</h4></li>
                    <li><h4>HIGHEST BID: '.$auction["highest_bid"].' KČ</h4></li>
                    <li><h4>STATUS: <span style="color: '.getColor($auction["status"]).'">'.$auction["status"].'</span></h4></li>
                    <li><h4>ENDS: '.$auction["end_time"].' <p>TIMELEFT: <span id="timer'.$auction["auction_id"].'"></span></p></h4></li>
                    <script type="text/javascript">getTimer(\''.$auction["end_time"].'\',document.getElementById("timer'.$auction["auction_id"].'"))</script>
                    <form method="post" action="my_auctions">
                        <input hidden name="auction_id" value="'.$auction["auction_id"].'">
                        <button type="submit">JOIN AUCTION</button>
                    </form>
                </ul>
            </div>';
        }
        ?>

    </section>
</div>
