<?php
//Connect to DB
$con = mysqli_connect('localhost','root','letmein','StockData');
session_start();
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

if(!isset($_POST['searchStock'])) {
    $searchStock = "";
} else {
    $searchStock = $_POST['searchStock'];
}

$qry = "SELECT DISTINCT ticker FROM stock_data WHERE ticker LIKE '%".$searchStock."%';";
$result = mysqli_query($con,$qry) or die(mysqli_error($con,$qry));
$stocksReturned = array();
foreach($result as $row) {
    foreach($row as $attr) {
        $stocksReturned[] = strval($attr);
    }
}
?>
<html>
<head>
    <!--Latest compiled and minified CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!--Optional theme-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

</head>
<div class="container">
    <br>
    <div class="well">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        <h1>Results</h1>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-striped">
            <?php
            foreach($stocksReturned as $stock) {
                echo "<tr>";
                echo '<td><div class="text-center"><b>'.$stock.'</b></div></td>';
                echo '<td><div class="text-center"><a href="previewStock.php?ticker='.$stock.'" class="btn btn-warning btn-md">Preview</a></div></td>';
                echo '<td><div class="text-center"><a href="followStock.php?ticker='.$stock.'" class="btn btn-success btn-md">Follow</a></div></td>';
                echo "</tr>";

            }
            ?>
        </table>
    </div>

</div>
    <footer>
    </footer>
    <!--Latest compiled and minified JavaScript-->
    <script src="https://code.jquery.com/jquery-2.2.2.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    </body>
</html>