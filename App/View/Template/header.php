<?php
function getPageIndex($title){
    switch ($title){
        case 'home': return 0;
        case 'create_action': return 1;
        case 'buy_items': return 2;
        case 'my_auctions': return 3;
        case 'licidator': return 4;
        case 'admin': return 5;
        case 'categories': return 6;
    }
}
?>

<!-- HEADER -->
<html>
<head>
    <!--   -->
    <title>WebBids - <?=$data['title']?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="<?=$data['stylesheet']?>">
    <link rel="stylesheet" href="App/View/Stylesheet/header.css">
    <script src='App/View/Javascript/database_func.js'></script>

    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css'>
    <!-- Font Awesome CSS -->
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
    <!-- jQuery -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <!-- Bootstrap JS -->
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js'></script>
    <!-- master.css -->
    <link rel="stylesheet" href="App/View/Stylesheet/master.css" type="text/css">
</head>
<body>
    <nav class="navbar navbar-default navbar-inverse" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul id="main-nav" class="nav navbar-nav">
                    <li><a href="home">Home</a></li>0
                    <li><a href="create_auction">Create Auction</a></li>
                    <li><a href="buy">Buy items</a></li>
                    <?php
                        if (isset($_SESSION['username'])){
                            echo '<li><a href="my_auctions">My auctions</a></li>';
                            echo $_SESSION['user_role'];
                            if ($_SESSION['user_role'] == 'licidator' || $_SESSION['user_role'] == 'admin'){
                                echo '<li><a href="licidator">Licidator</a></li>';
                                if ($_SESSION['user_role'] == 'admin'){
                                    echo '<li><a href="admin">Admin</a></li>';
                                }
                            }
                        }
                    ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Aktiva</a></li>
                            <li><a href="#">Majetok</a></li>
                            <li><a href="#">Zboží</a></li>
                        </ul>
                    </li>
                </ul>

                <!-- Set current loaded page nav link to active  -->
                <script type="text/javascript">
                    let nav_items = document.getElementById('main-nav').getElementsByTagName('li');
                    for (let i = 0; i < nav_items.length; i++){
                        console.log(i);
                        if (i === <?php echo getPageIndex($data['title'])?>){
                            nav_items[i].className = "active";
                        }
                    }
                </script>

                <!-- login status -->
                <ul class="nav navbar-nav navbar-right">
                    <?php
                        if (isset($_SESSION['username'])){
                            echo '<li><p class="navbar-text">'.$_SESSION['username'].'</p></li>';
                            echo '<li><p class="navbar-text"><button onclick="confirm_logout()">Logout</button></p></li>';
                        }
                        else{
                            echo '<li><p class="navbar-text"><a id="l/r" href="login">Login/register</a></p></li>';
                        }
                    ?>
                </ul>
                <script type="text/javascript">
                    function confirm_logout(){
                        if(confirm("Are you sure want to log out?")){
                            logout();
                        }
                    }
                </script>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
<!-- MAIN BODY -->