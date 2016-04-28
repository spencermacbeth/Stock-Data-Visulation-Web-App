<?php
session_start();
if (isset($_POST['submit'])) {

    $name = $_POST["recipientEmail"];
    $message = $_POST["message"];
    $message = str_replace("'", "\'", $message);
    $email = strtolower($_POST["username"]);
    $user = $_SESSION['user'];
    $display ='';
    $mysqli = mysqli_connect("localhost", "root", "letmein", "StockData");

    $sql = "SELECT email FROM users WHERE email = '" . $name . "'";
    $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

    if (mysqli_num_rows($result) == 0) {
        $display  = "Recipient does not exist!";

    }else{
        $sql = "INSERT INTO messages VALUES ('".$user."','".$name."', '".$message."')";
        $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
        header("Location: messages.php");
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

        #recipientEmail {
            width: 50%;
            margin: 20px;

        }
        #messageBox {
            width: 80%;
            margin: 20px;

        }
        .btn-primary{
            margin: 20px;
        }

    </style>
</head>
<body>
<div id="wrapper">
    <div class="container-fluid">
        <div class="row">
            <form method="post" action="createMessage.php" class="form-" role="form">
                <h3 class="form-signin-heading" style="margin-left: 20px">Send a message:</h3>
                <div id="recipientEmail">
                    <label>Recipient email: </label>
                    <input type="text" class="form-control" name="recipientEmail" placeholder="Recipient Email"/>
                </div>
                <div id="messageBox">
                    <label>Message: </label>
                    <textarea class="form-control" rows="4" name="message"></textarea>
                </div>
                <input class="btn btn-primary" type="submit" name="submit" value="Send">

                <p><?php echo $display ?></p>

            </form>
        </div>
    </div>
</div>


</body>
</html>

