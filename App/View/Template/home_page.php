<div id="home">
    <section id="current-auctions">
            <h1>CURRENT AUCTIONS</h1>
        <?php
        foreach ($data['auction_array'] as $auction){
            echo '
            <div class="info">
                <img class ="pic" src="img/1.jpg">
                <ul>
                    <li><h3>'.$auction["item_name"].'</h3></li>
                    <li>'.$auction["start_price"].' kc</li>
                    <li class="timer"><h4>ENDS: </h4></li>
                    <div class="timer"></div>
                    <li><a class="button" href="#section-it" >SUBMIT BID</a></li>
                </ul>
            </div>';
        }
        ?>

    </section>
</div>

<script>
    function f() {
        console.log("kokot")
    }

    function timeRemaining(deadline_date, id) {
        window.onload(function () {
            for (let t of document.getElementsByClassName('timer')) {
                let deadline_date = document.getElementById('p' + t.id.substr(5) + '5').innerHTML;
                let countDownDate = new Date(deadline_date).getTime();
                let now = new Date().getTime();
                let distance = countDownDate - now;
                let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = Math.floor((distance % (1000 * 60)) / 1000);
                t.innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
                if (distance < 0) {
                    clearInterval(x);
                    t.innerHTML = "None";
                }
            }
        })
        return setInterval(function (){
        let t = document.getElementById(id))
            let countDownDate = new Date(deadline_date).getTime();
            let now = new Date().getTime();
            let distance = countDownDate - now;
            let days = Math.floor(distance / (1000 * 60 * 60 * 24));
            let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((distance % (1000 * 60)) / 1000);
            t.innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
            if (distance < 0) {
                clearInterval(x);
                t.innerHTML = "None";
            }
    },1000)
    }
</script>