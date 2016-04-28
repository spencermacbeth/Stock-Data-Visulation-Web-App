
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Pacifico"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
        html, body, #wrapper {
            height: 100%;

        }

        .row {
            width: 100%;
            margin: 0;
        }

        #contentContainer {
            height: 30%;
            margin: 0;
            padding: 10px;
        }

        .container-fluid {
            height: 100%;
            background: #F5F5F5;

        }


        #myCarousel{
            float: left;
            height: 55%;
            margin: 0;
        }
        .carousel-inner > .item > img,
        .carousel-inner > .item > a > img {
            width: 100%;
            height: 100%;
        }

        #navbarButtons {
            margin-right: 20px;
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

        .navbar-header {
            margin-left: 20px;
        }

        #navbarButtons {

        }

        #myNavbar {

            text-align: center;

        }

        #contentWrapper {
            float: left;
            width: 100%;
            height: 100%;
            padding: 0;
            position: relative;
            transition: all .4s ease 0s;
        }

        #mainWrapper {
            height: 90%;
            width: 100%;
            padding: 0;
            margin: 0;
            transition: all .4s ease 0s;
        }

        #contentDiv {
            padding: 0;
        }

        .jumbotron {
            text-align: center;
            height: 15%;
            margin: 0;
        }

        #logo {
            margin: 10px;
            height: 60px;
        }

        h1 {
            font-family: Pacifico;
        }

        h2 {
            font-family: Pacifico;
            margin: 10px;
        }

        h3 {
            font-family: Pacifico;
            margin: 3px;
        }
        #aboutDiv{
            padding: 10px;
            border: 2px solid;
            border-radius: 5px;
            border-color: #607D8B;
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

            <a href="#" class="pull-left"><img id="logo" src="GRDT.png"></a>
        </div>

        <div class="collapse navbar-collapse" id="myNavbar">

            <ul id="navbarButtons" class="nav navbar-nav navbar-right">

                <li>
                    <a href="login.php">
                        <button type="button" class="btn btn-info navbar-btn btn-lg"
                        "><span
                            class="glyphicon glyphicon-log-in"></span> Login
                        </button>
                    </a>
                </li>
                <li>
                    <a href="register.php">
                        <button type="button" class="btn btn-info navbar-btn btn-lg"
                        "><span
                        ></span> Register
                        </button>
                    </a>
                </li>

            </ul>
            <div class="col-xs-6 ">

            </div>


        </div>


    </div>

    <div id="mainWrapper">
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">How to get started:</h4>
                    </div>
                    <div class="modal-body">
                        <p>We recommend some financial background to use this website to the fullest.
                        </p>
                        <p>1. Login, or create an account if you do not have one.
                        </p>
                        <p>2. Once logged in by using the buttons on the top right, you will be taken to your
                            personalized dashboard.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <div id="contentWrapper">
            <div id="contentDiv" class="container-fluid">
                <div class="row">

                    <div class="jumbotron">
                        <h2>Get Rich or Die Tryin.</h2>
                        <p></p>
                    </div>
                    <div id="contentContainer" class="container-fluid">
                        <div class="row">
                            <div class="col-xs-6" style="text-align: center; padding: 20px;">
                                <h3>About</h3>
                                <br>
                                <div id="aboutDiv">
                                    <p><strong>Get Rich or Die Trying! Need we say anymore?... GRDT is your personalized
                                            hub for
                                            gaining insights on

                                            the stocks that matter most. Browse the details of over a decade’s worth of
                                            data on
                                            over 500

                                            companies. If you see a stock that interests you, why not follow it? GRDT
                                            gives you
                                            the ability to visually

                                            track the trends of the most important metrics of the most important stocks
                                            so you
                                            can get that money!</strong>
                                </div>
                            </div>
                            <div class="col-xs-6" style="text-align: center; margin-top: 60px;">
                                <button type="button" class="btn btn-default btn-lg" data-toggle="modal"
                                        data-target="#myModal"><span
                                    ></span> How To Get Started
                                </button>
                            </div>
                        </div>
                    </div>
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                            <li data-target="#myCarousel" data-slide-to="3"></li>

                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <img src="stockmarket.jpg" alt="StockMarket">
                                <div class="carousel-caption">
                                    <h1>Stock Trends</h1>
                                    <p style="font-size: 20px;">View historical stock trends with metrics</p>
                                </div>
                            </div>

                            <div class="item">
                                <img src="pricetobook.png" alt="PriceToBOok">
                                <div class="carousel-caption">

                                </div>
                            </div>
                            <div class="item">
                                <img src="pegratio.png" alt="PegRatio">
                                <div class="carousel-caption">

                                </div>
                            </div>
                            <div class="item">
                                <img src="debtoequity.png" alt="DebtToEquity">
                                <div class="carousel-caption">

                                </div>
                            </div>

                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    //sidebar jquery script
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#mainWrapper").toggleClass("toggled");
    });
    //iframe source change script
    function setURL(url) {
        document.getElementById('iframeId').src = url;
    }
</script>

</body>
</html>

