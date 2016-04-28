<?php

session_start();

if(!isset($_SESSION['user'])) {
    header("Location: login.php");
} else {

    $username = $_SESSION['user'];
    $ticker = $_GET['ticker'];

    //Connect to DB
    $con = mysqli_connect('localhost','root','letmein','StockData');

    if (!$con) {
        die('Could not connect: ' . mysqli_error($con));
    }

    if(!isset($_POST['searchStock'])) {
        $searchStock = "";
    } else {
        $searchStock = $_POST['searchStock'];
    }

    $qry = "INSERT INTO follows_stock VALUES('".$username."', '".$ticker."');";
    $result = mysqli_query($con,$qry) or die(mysqli_error($con,$qry));

    if($result) {
        ?>
        <html>
        <head>
            <!--Latest compiled and minified CSS-->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

            <!--Optional theme-->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

        </head>
        <body>
        <div class="container">
            <div class="col-md-12">
                <div class="well">
                    <div class="panel panel-default panel-info">
                        <div class="panel-heading"><h3 class="panel title">Follow Successful</h3></div>
                        <div class="panel-body">
                            <div class="text-center"><h1>You started following <?php echo $ticker?>.</h1>
                                <div class="text-center"><h3>Click the button below to visit your visualizer and gain some new insights now!</h3></div>
                                <a href="visualizeQueryData.php" class="btn btn-success btn-md">See the light</a>
                            </div>
                        </div>
                    </div>
                </div>


                <footer>
                </footer>
                <!--Latest compiled and minified JavaScript-->
                <script src="https://code.jquery.com/jquery-2.2.2.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        </body>
        </html>
        <?php
    } else {
        echo "failure";
    }
}
