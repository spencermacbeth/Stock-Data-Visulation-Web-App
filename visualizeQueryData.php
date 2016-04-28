<?php
session_start();
//Connect to DB
$con = mysqli_connect('localhost','root','letmein','StockData');

if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$username = $_SESSION["user"];
//Get all the tickers the user is following
$qry = "SELECT ticker FROM follows_stock WHERE username = '".$username."';";
$result = mysqli_query($con,$qry) or die(mysqli_error($con,$qry));
$followedStocks = array();

if(mysqli_num_rows == 0) {
    //header("Location: search.php");
}

foreach($result as $row) {
    foreach($row as $attr) {
        $followedStocks[] = strval($attr);
    }
}

//Set all the tickers and metrics, use the first in the list of tickers the
//follow as default for visualization if not user input
if(!isset($_POST['pie_ticker'])) {
    $pie_ticker = $followedStocks[0];
} else {
    $pie_ticker = $_POST['pie_ticker'];
}
if(!isset($_POST['bar_ticker'])) {
    $bar_ticker = $followedStocks[0];
} else {
    $bar_ticker = $_POST['bar_ticker'];
}
if(!isset($_POST['line_ticker'])) {
    $line_ticker = $followedStocks[0];
} else {
    $line_ticker = $_POST['line_ticker'];
}

if(!isset($_POST['pie_metric'])) {
    $pie_metric = "peg_ratio";
} else {
    $pie_metric = $_POST['pie_metric'];
}
if(!isset($_POST['bar_metric'])) {
    $bar_metric = "peg_ratio";
} else {
    $bar_metric = $_POST['bar_metric'];
}
if(!isset($_POST['line_metric'])) {
    $line_metric = "peg_ratio";
} else {
    $line_metric = $_POST['line_metric'];
}


//Set up and execute all the queries for the visualizations
$qryPie = "SELECT date, ".$pie_metric." FROM stock_data WHERE ticker = '".$pie_ticker."' AND ".$pie_metric." != '0.0' ;";
$qryBar = "SELECT date, ".$bar_metric." FROM stock_data WHERE ticker = '".$bar_ticker."' AND ".$bar_metric." != '0.0';";
$qryLine = "SELECT date, ".$line_metric." FROM stock_data WHERE ticker = '".$line_ticker."' AND ".$line_metric." != '0.0';";
$qryTable = "SELECT ticker, AVG(peg_ratio) as peg_ratio, AVG(price_to_book) as price_to_book, AVG(debt_to_equity) as debt_to_equity from stock_data WHERE ticker IN"
    . " (SELECT ticker FROM follows_stock WHERE username = '".$username."')"
    . "GROUP BY ticker;";

$resultPie = mysqli_query($con,$qryPie);
$resultBar = mysqli_query($con,$qryBar);
$resultLine = mysqli_query($con,$qryLine);
$resultTable = mysqli_query($con,$qryTable);


//Create JSON objects in format for google chart's api for all metrics
$tableTable = array();
$tableTable['cols'] = array(
    //Labels for the chart, these represent the column titles
    array('id' => '', 'label' => 'Ticker', 'type' => 'string'),
    array('id' => '', 'label' => 'PegRatio', 'type' => 'number'),
    array('id' => '', 'label' => 'PriceToBook', 'type' => 'number'),
    array('id' => '', 'label' => 'DebtToEquity', 'type' => 'number')

);

$rowsTable = array();
foreach($resultTable as $row){
    $temp = array();
    //Values
    $temp[] = array('v' => (string) $row['ticker']);
    $temp[] = array('v' => (float) $row['peg_ratio']);
    $temp[] = array('v' => (float) $row['price_to_book']);
    $temp[] = array('v' => (float) $row['debt_to_equity']);

    $rowsTable[] = array('c' => $temp);
}

$resultTable->free();
$tableTable['rows'] = $rowsTable;

$tablePie = array();
$tablePie['cols'] = array(
    //Labels for the chart, these represent the column titles
    array('id' => '', 'label' => 'Date', 'type' => 'string'),
    array('id' => '', 'label' => $pie_metric, 'type' => 'number')
);

$rowsPie = array();
foreach($resultPie as $row){
    $temp = array();
    //Values
    $temp[] = array('v' => (string) $row['date']);
    $temp[] = array('v' => (float) $row[$pie_metric]);
    $rowsPie[] = array('c' => $temp);
}

$resultPie->free();
$tablePie['rows'] = $rowsPie;

$tableBar = array();
$tableBar['cols'] = array(
    //Labels for the chart, these represent the column titles
    array('id' => '', 'label' => 'Date', 'type' => 'string'),
    array('id' => '', 'label' =>  $bar_metric, 'type' => 'number')
);

$rowsBar = array();
foreach($resultBar as $row){
    $temp = array();
    //Values
    $temp[] = array('v' => (string) $row['date']);
    $temp[] = array('v' => (float) $row[$bar_metric]);
    $rowsBar[] = array('c' => $temp);
}

$resultBar->free();
$tableBar['rows'] = $rowsBar;

$tableLine = array();
$tableLine['cols'] = array(
    //Labels for the chart, these represent the column titles
    array('id' => '', 'label' => 'Date', 'type' => 'string'),
    array('id' => '', 'label' =>  $line_metric, 'type' => 'number')
);

$rowsLine = array();
foreach($resultLine as $row){
    $temp = array();
    //Values
    $temp[] = array('v' => (string) $row['date']);
    $temp[] = array('v' => (float) $row[$line_metric]);
    $rowsLine[] = array('c' => $temp);
}

$resultLine->free();
$tableLine['rows'] = $rowsLine;
mysqli_close($con);

//    echo '<pre>';
//    echo json_encode($tablePie, JSON_PRETTY_PRINT);
//    echo '</pre>';
?>
<html>
<head>
    <!--Latest compiled and minified CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!--Optional theme-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <style type="text/css">
        .col-md-9 {
            background-color: grey;
        }

        .col-md-3 {
            background-color: black;
        }
    </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart','table']});

        google.charts.setOnLoadCallback(drawTable);

        function drawTable() {

            //Create and draw data table
            var jsonDataTable = <?php echo json_encode($tableTable); ?>;
            var dataTable = new google.visualization.DataTable(jsonDataTable);
            var tableTable = new google.visualization.Table(document.getElementById('table_div'));
            tableTable.draw(dataTable, {showRowNumber: true, width: '100%', height: '100%'});

            // Create and draw pie chart
            var jsonDataPie = <?php echo json_encode($tablePie); ?>;
            var pieData = new google.visualization.DataTable(jsonDataPie);

            // Set chart options
            var options = {'width':400,
                'height':290};

            // Instantiate and draw our chart, passing in some options.
            var pieChart = new google.visualization.PieChart(document.getElementById('pie_div'));
            pieChart.draw(pieData, options);


            //Create and draw Bar Chart
            var jsonDataBar = <?php echo json_encode($tableBar); ?>;
            var barData = new google.visualization.DataTable(jsonDataBar);
            var options = {
                legend: { position: 'none' },
            };

            var barChart = new google.visualization.Histogram(document.getElementById('bar_div'));
            barChart.draw(barData, options);

            //Create and draw line chart
            var jsonDataLine = <?php echo json_encode($tableLine); ?>;
            var lineData = new google.visualization.DataTable(jsonDataLine);
            var options = {
                title: 'Company Performance',
                curveType: 'function',
                legend: { position: 'bottom' }
            };

            var chartLine = new google.visualization.LineChart(document.getElementById('line_div'));
            chartLine.draw(lineData, options);
        }

    </script>
</head>
<body>
<!--    Sets up 4 divs that are targeted by the draw methods in the last drawTable() method-->
<div class="container">
    <br>

    <div class="col-md-12">
        <div class="panel panel-default panel-info">
            <div class="panel-heading"><h3 class="panel title">Your followed stocks and the average of their metrics over time</h3></div>
            <div class="panel-body">
                <div id="table_div" style="width: 100%; height: 30%;"></div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel title"><h2><b>Welcome to your Visualizer!</b></h2></div>
            <div class="panel-body">
                <p>GRDT currently supports visualizations for what we deem to be the three
                    most important metrics for the performance of a stock in today's modern economy:
                    the PEG ratio, total debt to equity, and the price to book. To learn more about these
                    metrics, <a href="about.php">click here.</a></p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default panel-info">
                <div class="panel-heading"><h3 class="panel title">Histogram of <b><?php echo str_replace("_", " ", $bar_metric);?></b> by <b>year</b> for <?php echo $bar_ticker?> </h3></div>
                <div class="panel-body">
                    <div id="bar_div" style="width: 100%; height: 50%;"></div>
                    <br>
                    <form action="" method="post">
                        <input type="hidden" name="bar_ticker" value=<?php echo '"'.$bar_ticker.'"';?>>
                        <input type="hidden" name="bar_metric" value=<?php echo '"'.$bar_metric.'"';?>>
                        <input type="hidden" name="pie_ticker" value=<?php echo '"'.$pie_ticker.'"';?>>
                        <input type="hidden" name="pie_metric" value=<?php echo '"'.$pie_metric.'"';?>>
                        <input type="hidden" name="line_ticker" value=<?php echo '"'.$line_ticker.'"';?>>
                        <input type="hidden" name="line_metric" value=<?php echo '"'.$line_metric.'"';?>>
                        <select name="bar_ticker">
                            <?php foreach($followedStocks as $ticker){
                                echo '<option value="'.$ticker.'">'.$ticker.'</option>';
                            }
                            ?>
                        </select>
                        <select name="bar_metric">
                            <option value="peg_ratio">PEG Ratio</option>
                            <option value="price_to_book">Price to Book</option>
                            <option value="debt_to_equity">Debt to Equity</option>
                        </select>
                        <br><br>
                        <input  class="btn btn-primary" type="submit">
                    </form>

                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default panel-info">
                <div class="panel-heading"><h3 class="panel title">Pie chart of <b><?php echo str_replace("_", " ", $pie_metric);?></b> by <b>year</b> for <?php echo $pie_ticker?></h3></div>
                <div class="panel-body">
                    <div id="pie_div" style="width: 100%; height: 50%;"></div>
                    <br>
                    <form action="" method="post">
                        <input type="hidden" name="bar_ticker" value=<?php echo '"'.$bar_ticker.'"';?>>
                        <input type="hidden" name="bar_metric" value=<?php echo '"'.$bar_metric.'"';?>>
                        <input type="hidden" name="pie_ticker" value=<?php echo '"'.$pie_ticker.'"';?>>
                        <input type="hidden" name="pie_metric" value=<?php echo '"'.$pie_metric.'"';?>>
                        <input type="hidden" name="line_ticker" value=<?php echo '"'.$line_ticker.'"';?>>
                        <input type="hidden" name="line_metric" value=<?php echo '"'.$line_metric.'"';?>>
                        <select name="pie_ticker">
                            <?php foreach($followedStocks as $ticker){
                                echo '<option value="'.$ticker.'">'.$ticker.'</option>';
                            }
                            ?>
                        </select>

                        <select name="pie_metric">
                            <option value="peg_ratio">PEG Ratio</option>
                            <option value="price_to_book">Price to Book</option>
                            <option value="debt_to_equity">Debt to Equity</option>
                        </select>
                        <br><br>
                        <input  class="btn btn-primary" type="submit">
                    </form>

                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="panel panel-default panel-info">
                <div class="panel-heading"><h3 class="panel title">Line graph of <b><?php echo str_replace("_", " ", $line_metric);?></b> by <b>year</b> for <?php echo $line_ticker?></h3></div>
                <div class="panel-body">
                    <div id="line_div" style="width: 100%; height: 50%;"></div>

                    <form action="" method="post">
                        <input type="hidden" name="bar_ticker" value=<?php echo '"'.$bar_ticker.'"';?>>
                        <input type="hidden" name="bar_metric" value=<?php echo '"'.$bar_metric.'"';?>>
                        <input type="hidden" name="pie_ticker" value=<?php echo '"'.$pie_ticker.'"';?>>
                        <input type="hidden" name="pie_metric" value=<?php echo '"'.$pie_metric.'"';?>>
                        <input type="hidden" name="line_ticker" value=<?php echo '"'.$line_ticker.'"';?>>
                        <input type="hidden" name="line_metric" value=<?php echo '"'.$line_metric.'"';?>>
                        <select name="line_ticker">
                            <?php foreach($followedStocks as $ticker){
                                echo '<option value="'.$ticker.'">'.$ticker.'</option>';
                            }
                            ?>
                        </select>
                        <select name="line_metric">
                            <option value="peg_ratio">PEG Ratio</option>
                            <option value="price_to_book">Price to Book</option>
                            <option value="debt_to_equity">Debt to Equity</option>
                        </select>
                        <br><br>
                        <input  class="btn btn-primary" type="submit">
                    </form>

                </div>
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