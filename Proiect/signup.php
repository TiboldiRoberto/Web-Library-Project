<?php
session_start();

include("connection.php");
include("functions.php");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Signup</title>
    <link rel="stylesheet" href="style.css">
    <!-- Sweet Box Message Alert! -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style type="text/css">
        #login {
            text-align: center;
            color: darkslategrey;
            font-size: 1.5em;
            font-family: sans-serif;
            margin: 15px 0px;
        }

        .text {
            display: block;
            margin: 0px auto;
            height: 25px;
            border-radius: 5px;
            padding: 4px;
            border: 2px solid dodgerblue;
        }

        #button {
            display: block;
            margin-right: auto;
            margin-left: auto;
            padding: 10px;
            width: 100px;
            color: white;
            background-color: dodgerblue;
            border: none;
            cursor: pointer;
            border-radius: 10px;
            outline: none;
        }

        #box {
            width: 300px;
            height: 340px;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-top: -180px;
            /* this is half the height of your div*/
            margin-left: -160px;
            /*this is half of width of your div*/
            background-color: white;
            border-radius: 50px;
            border: 5px solid dodgerblue;
        }

        a {
            display: block;
            text-align: center;
            margin: 0 auto;
            font-family: sans-serif;
            font-size: 1.1em;
            color: darkslategrey;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <?php
    include "navbar.php";
    ?>
    <div id="box">

        <form method="POST">
            <div id="login">Sign up</div>
            <br>
            <input class="text" type="text" name="username" placeholder="Username"><br>
            <input class="text" type="email" name="email" placeholder="Email"><br>
            <input class="text" type="password" name="password" placeholder="Password"><br>

            <input id="button" type="submit" value="Sign up"><br>


            <a href="login.php">Click to Log in</a><br>
        </form>
    </div>
    <br><br><br><br><br><br>
    <br><br><br><br><br><br>
    <br><br><br><br><br><br>
    <br><br><br><br><br><br>
    <br><br><br><br><br><br>
    <br><br><br>

    <footer>
        <div class="container">
            <div class="footer-text">
                &#169 2021 Copyright. Designed by Tiboldi Roberto.
            </div>
        </div>
    </footer>
</body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $password = md5($password);
    $email = $_POST['email'];
    $query = "SELECT * from users where email = '$email'";
    $result = mysqli_query($con, $query);

    if ($result->num_rows == 0) {
        if (!empty($username) && !empty($password) && !is_numeric($username)) {

            //save to database
            $date = date("Y-m-d H:i:s");
            $query = "insert into users (username,password,email,date) values ('$username','$password','$email','$date')";

            mysqli_query($con, $query);

            header("Location: login.php");
            die;
        } else {
            echo '<script>alert("Please enter some valid information!")</script>';
        }
    } else {
        echo '<script>swal("Info!", "Someone was already registred with this email!", "info");</script>';
    }
}

?>