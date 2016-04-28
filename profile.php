<?php
$display = '';
session_start();

$mysqli = mysqli_connect("localhost", "root", "letmein", "StockData");

$email = $_SESSION['user'];
$password = filter_input(INPUT_POST, 'password');

$sql = "SELECT firstname,lastname FROM users WHERE email = '" . $email . "'";

$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));


while ($info = mysqli_fetch_array($result)) {
    $f_name = stripslashes($info['firstname']);
    $l_name = stripslashes($info['lastname']);
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


        #profile {

            border: 2px solid #337AB7;
            border-radius: 20px;
            padding: 20px;
            margin: 0;
            background: white;

        }
        #firstName,#lastName,#email{
            font-size: 20px;
        }
    </style>
</head>
<body>
<div id="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div id="profile" class="col-xs-6">
                <h3>Your Profile:</h3>
                <div id="firstName">
                    <p>First Name: <?php echo $f_name ?></p>
                </div>
                <div id="lastName">
                    <p>Last Name: <?php echo $l_name ?></p>
                </div>
                <div id="email">
                    <p>Email: <?php echo $email ?></p>
                </div>
            </div>
            <div class="col-xs-6">
                <a href="editProfile.php">
                    <button type="button" class="btn btn-info btn-lg"
                    "><span
                        class="glyphicon glyphicon-envelope"></span> Edit Profile
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>


</body>
</html>


