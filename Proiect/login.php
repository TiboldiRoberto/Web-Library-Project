<!DOCTYPE html>
<html>

<head>
    <title>Log in</title>
    <link rel="stylesheet" href="style.css">
</head>
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
        height: 300px;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-top: -160px;
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

<body>
    <?php
    include "navbar.php";
    ?>
    <div id="box">
        <form method="POST">
            <div id="login">Log in</div>

            <input class="text" type="text" name="username" placeholder="Username"><br>
            <input class="text" type="password" name="password" placeholder="Password"><br>
            <?php
            session_start();

            include("connection.php");
            include("functions.php");


            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                //something was posted
                $username = mysqli_real_escape_string($con, $_POST['username']);
                $password = mysqli_real_escape_string($con, $_POST['password']);
                $password = md5($password);

                if (!empty($username) && !empty($password)) {
                    //read from database
                    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
                    $result = mysqli_query($con, $query);

                    if (mysqli_num_rows($result) > 0) {
                        $_SESSION['username'] = $username;
                        header("Location: index.php");
                    } else {
                        //echo'<script>alert("Wrong User Details!")</script>';
                        echo "<p style=\"color:red; text-align: center;\" >Wrong username or password!</p><br>";
                    }
                } else {
                    echo '<script>alert("Complete required fields!")</script>';
                }
            }
            ?>
            <input id="button" type="submit" value="Log in"><br>
            <a href="signup.php">Sign up</a><br>
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