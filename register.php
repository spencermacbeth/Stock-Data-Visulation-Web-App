<?php
session_start();
if (isset($_POST['submit'])) {
    $Fname = $_POST["firstname"];
    $Lname = $_POST["lastname"];
    $email = strtolower($_POST["username"]);
    $password = $_POST["password"];
    $display ='';
    $mysqli = mysqli_connect("localhost", "root", "letmein", "StockData");
    $sql = "SELECT firstname FROM users WHERE email = '" . $email . "'";
    $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

    if (mysqli_num_rows($result) == 1) {
        $display  = "Your email address has already been used! Please use a different email address";

    }else{
        $sql = "INSERT INTO users VALUES ('".$Fname."', '".$Lname."', '".$email."', '" . $password . "')";
        $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
        $_SESSION['user'] = $email;
        $_SESSION['name'] = $Fname;
        header("Location: home.php");
        exit;
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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
        #email ,#firstName ,#lastName ,#password {

        }
        p{
            text-align: left;

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
            <div class="col-xs-2 col-sm-3 col-md-3 col-lg-2"></div>
            <div class="col-xs-8 col-sm-6 col-md-6 col-lg-8">
                <form method="post" action="register.php" class="form-signin">
                    <h3 class="form-signin-heading">Register</h3>
                    <div id="firstName">
                        <p>First name: </p>
                        <input type="text" class="form-control" name="firstname" placeholder="First name"/>
                    </div>
                    <div id="lastName">
                        <p>Last name: </p>
                        <input type="text" class="form-control" name="lastname" placeholder="Last name"/>
                    </div>
                    <div id="email">
                        <p>Email: </p>
                        <input type="text" class="form-control" name="username" placeholder="Email Address"/>
                    </div>
                    <div id="password">
                        <p>Password: </p>
                        <input type="password" class="form-control" name="password" placeholder="Password"/>
                    </div>
                    <button class="btn btn-primary" name="submit" type="submit">Register</button>

                    <p><?php echo $display ?></p>

                </form>
            </div>
            <div class="col-xs-2 col-sm-3 col-md-3 col-lg-2"></div>
        </div>
    </div>
</div>


</body>
</html>

