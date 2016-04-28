<?php
session_start();
if (isset($_POST['submit'])) {
    $display = '';


    $mysqli = mysqli_connect("localhost", "root", "letmein", "StockData");

    $email = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');
    $sql = "SELECT firstname FROM users WHERE email = '" . $email . "' AND password = '". $password ."'";

    $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));


    if (mysqli_num_rows($result) == 1) {
        $_SESSION['user'] = $email;
        while ($info = mysqli_fetch_array($result)) {
            $f_name = stripslashes($info['firstname']);

        }
        header("Location: home.php");
        exit;
    } else {
        $display = "Incorrect username/password";
    }
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
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
        html, body, #wrapper {
            height: 100%;
            background-color: #F5F5F5;
        }

        .row {
            border: 2px solid #337AB7;
            border-radius: 20px;
            padding: 0;
            margin-top: 10%;
            margin-bottom: 10%;
            margin-left: 25%;
            margin-right: 25%;
            background: white;
        }

        .form-signin {
            text-align: center;

        }

        .form-signin h3 {
            text-align: left;
            margin: 15px;
            margin-left: 0;

        }

        .form-signin a {
            text-align: left;
            margin: 15px;

        }

        .form-signin .btn-primary {
            width: 80%;
            margin: 15px;

        }

        .form-control {
            margin-top: 10px;
            margin-bottom: 10px;

        }

        .form-signin-heading {
            margin-bottom: 25px;
        }
    </style>
</head>
<body>
<div id="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-2 col-sm-3 col-md-4 col-lg-4"></div>
            <div class="col-xs-8 col-sm-6 col-md-4 col-lg-4">
                <form method="POST" action="login.php" class="form-signin">
                    <h3 class="form-signin-heading">User Login</h3>
                    <input type="email" class="form-control" name="username" placeholder="Email Address"/>
                    <input type="password" class="form-control" name="password" placeholder="Password"/>
                    <input class="btn btn-primary" type="submit" name="submit" value="Login">
                    <div>
                        <p>Dont have an account? <br>Sign up!</p>
                        <a href="register.php">Register</a>
                    </div>
                    <p><?php echo $display ?></p>
                </form>
            </div>
            <div class="col-xs-2 col-sm-3 col-md-4 col-lg-4"></div>
        </div>
    </div>
</div>


</body>
</html>

