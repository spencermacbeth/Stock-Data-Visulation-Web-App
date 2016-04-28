<?php
session_start();
header('X-Frame-Options: GOFORIT');
$userEmail = $_SESSION['user'];

?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lato"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
        html, body,#wrapper{
            height: 100%;

        }
        .row{
            width: 100%;
            margin: 0;
        }
        .container-fluid {
            height: 100%;
            background: #F5F5F5;

        }
        .navbar-collapse{

        }
        .navbar-collapse ul li {
            padding: 10px;


        }

        .navbar-collapse ul li a {
            padding: 0;

        }

        .navbar-default {
            margin: 0;
            border: 2px solid;
            border-radius: 0;
            border-color: #455A64;

        }
        .navbar-form{
            margin: 0;
            margin-top: 17px;
            width: 100%;

        }
        .navbar-header{


        }
        #navbarButtons{


        }
        #myNavbar {

            text-align: center;

        }

        #contentWrapper {
            float: left;
            width: 85%;
            height: 100%;
            padding: 0;
            position: relative;
            transition: all .4s ease 0s;
        }

        #sidebarWrapper {

            float: left;
            padding: 0;
            margin: 0px;
            width: 15%;
            height: 100%;
            background: #607D8B;
            transition: all .4s ease 0s;
        }

        #mainWrapper {
            height: 92%;
            width: 100%;
            padding: 0;
            margin: 0;
            transition: all .4s ease 0s;
        }

        #mainWrapper.toggled #sidebarWrapper {
            height: 100%;
            padding: 0;
            width: 0;
            transition: all .4s ease 0s;
        }

        #mainWrapper.toggled #contentWrapper {
            height: 100%;
            width: 100%;
            padding: 0;
            margin: 0;
            transition: all .4s ease 0s;

        }

        .sidebar-nav {
            list-style: none;
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
            text-align: center;
            transition: all .4s ease 0s;

        }

        .sidebar-nav li {
            line-height: 70px;
        }

        .sidebar-nav li a {

            font-size: 22px;
            color: white;
            display: block;
            text-decoration: none;

        }

        .sidebar-nav li a:hover {
            text-decoration: none;
            font-size: 26px;
            color: #2b2d2f;
            line-height: 80px;
            background: #B0BEC5;
            transition: all .3s ease 0s;
        }
        #logo{
            height: 50px;
            margin: 10px;

        }
        #contentDiv {
            padding: 0;
        }
        #menu-toggle{
            margin: 15px;
        }

    </style>
</head>
<body>
<div id="wrapper">
    <div class="navbar navbar-default " style="background-color: #607D8B" ;>

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>

            </button>
            <button type="button" class="pull-left btn btn-info navbar-btn" id="menu-toggle" ><span
                    class="glyphicon glyphicon-menu-hamburger"></span> Menu
            </button>
            <a  href="#" class="img-fluid pull-left "><img id="logo" src="GRDT.png"></a>
        </div>

        <div class="collapse navbar-collapse" id="myNavbar">

            <ul id="navbarButtons" class="nav navbar-nav navbar-right">

                <li>
                    <button type="button" class="btn btn-info navbar-btn" data-toggle="modal" data-target="#myModal" style="margin-right: 15px;"><span
                            class="glyphicon glyphicon-info-sign"></span> Info
                    </button>
                </li>


            </ul>
            <div id="searchDiv">
                <form action="search.php" method="POST" target="iframeName" class="navbar-form" role="search" >
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search Stocks" name="searchStock">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
            <p class="pull-right" style="color: white">Logged in as: <?php echo $userEmail ?></p>

        </div>


    </div>

    <div id="mainWrapper" class="toggled" >
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Info</h4>
                    </div>
                    <div class="modal-body">
                        <p>-Click the menu button to access the side bar with additional features.
                        </p>
                        <p>-Stocks displays your currently followed stocks lists and the graphs associated for each stock.
                        </p>
                        <p>-Thanks to Yahoo! Finance, we have a news section that allows for additional stock info and headlines.
                        </p>
                        <p>-View and change your profile info through the Profile tab.
                        </p>
                        <p>-Send messages through other users on the Messages page.
                        </p>
                        <p>-Read more about our stock metrics by clicking About.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <div id="sidebarWrapper">
            <ul class="sidebar-nav">
                <li>
                    <a href="#" onclick="setURL('visualizeQueryData.php');">Stocks</a>
                </li>
                <li>
                    <a href="#" onclick="setURL('https://finance.yahoo.com/quotes/EMBED,CODE,IN,XAML,C/view/e');">News</a>
                </li>
                <li>
                    <a href="#" onclick="setURL('profile.php');">Profile</a>
                </li>
                <li>
                    <a href="#" onclick="setURL('messages.php');">Messages</a>
                </li>
                <li>
                    <a href="#" onclick="setURL('about.php');">About</a>
                </li>
                <li>
                    <a href="logout.php">Logout
                    </a>
                </li>


            </ul>
        </div>
        <div id="contentWrapper">
            <div id="contentDiv" class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <iframe id="iframeId" name="iframeName" src="visualizeQueryData.php" width="100%" height="100%" frameborder="0"><?php header('X-Frame-Options: GOFORIT'); ?></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#mainWrapper").toggleClass("toggled");
    });

    function setURL(url){
        document.getElementById('iframeId').src = url;
    }
</script>

</body>
</html>
