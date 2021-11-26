<!-- HEADER -->
<html>
<head>
    <!--   -->
    <title>WebBids - <?=$data['title']?></title>
    <meta charset="UTF-8">
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
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Link</a></li>0
                    <li><a href="#">Link</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                            <li class="divider"></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Home</a></li>0
                        <li><a href="#">Create Auction</a></li>
                        <li><a href="#">Buy items</a></li>
                        <li><a href="#">My auctions</a></li>
                        <li><a href="#">Liciterator page</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Aktiva</a></li>
                                <li><a href="#">Majetok</a></li>
                                <li><a href="#">Zboží</a></li>

                <!-- Set current loaded page nav link to active  -->
                <!-- <script type="text/javascript">
                    let nav_items = document.getElementById('main-nav').getElementsByTagName('li');
                    for (let i = 0; i < nav_items.length; i++){
                        console.log(i);
                        if (i === <?=$data['activeLI']?>){
                            nav_items[i].className = "active";
                        }
                    }
                </script> -->

                <!-- login status -->
                <ul class="nav navbar-nav navbar-right">
                    <li><p class="navbar-text">
                    <?php
                        if (isset($_SESSION['username']) && $_SESSION['valid']){
                            echo $_SESSION['username'];
                        }
                        else{
                            echo '<a id="l/r" href="login">Login/register</a>';
                        }
                    ?>
                    </p></li>
                    <?php
                    if (isset($_SESSION['username']) && $_SESSION['valid']){
                        echo '<li><p class="navbar-text"><button onclick="confirm_logout()">Logout</button></p></li>';
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