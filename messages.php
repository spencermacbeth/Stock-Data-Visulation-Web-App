<?php
$display = '';
session_start();

$mysqli = mysqli_connect("localhost", "root", "letmein", "StockData");

$email = $_SESSION['user'];


$sql = "SELECT fromR ,message FROM messages WHERE toR = '" . $email . "' ";

$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));


while ($info = mysqli_fetch_array($result)) {
    $from = stripslashes($info['fromR']);
    $message = stripslashes($info['message']);
    $display .= "<tr><td>" . $from . "</td><td>" . $message . "</td></tr>";
}

?>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
        html, body, #wrapper {
            height: 100%;
            background-color: #F5F5F5;
        }

        .row {

            padding: 20px;
            height: 100%;
            width: 100%;
        }

        .col-xs-8 {

            border: 2px solid #337AB7;
            border-radius: 20px;
            padding: 20px;
            margin: 0;
            background: white;

        }

        .table {
            font-size: 20px;
            width: auto;
        }

        .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
            background-color: #F5F5F5;
        }

    </style>
</head>
<body>
<div id="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-8">
                <h3>Your Messages:</h3>
                <table class="table  table-hover">
                    <thead>
                    <tr>
                        <th>From</th>
                        <th>Message</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php echo $display ?>
                    </tbody>
                </table>
            </div>

            <div class="col-xs-4">
                <a href="createMessage.php">
                    <button type="button" class="btn btn-info btn-lg"
                    "><span
                        class="glyphicon glyphicon-envelope"></span> Send a Message
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>


</body>
</html>

