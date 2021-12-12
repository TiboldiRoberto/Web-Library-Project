<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sendbox</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Sweet Box Message Alert! -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <?php
    include "navbar.php";
    ?>
    <div class="banner">
        <img src="banners/b4.jpg" class="banner-img">
        <table class="search" id="search-table">
            <tr>
                <td><input type="text" placeholder="Search Author"></td>
                <td>
                    <a href="#" class="search-ico">
                        <img class="material-icons" src="images/search_ico.png" width="40px" height="40px" style="margin-top: 2px;">
                    </a>
                </td>
            </tr>
        </table>
    </div>
    <!-- Sub-nav -->
    <div class="nav-container">
        <div class=" sub-nav-container">
            <div class="welcome-text">
                Hello <?php echo $user_data['username']; ?>!
            </div>
            <table class="icons-style">
                <tr>
                    <td><a href="login.php"><img src="images/login_ico.png" width="35px" height="35px" alt="login"></a> </td>
                    <td><a href="cart.php"><img src="images/cart_ico.png" width="50px" height="50px" alt="cart"></a></td>
                    <td><a href="logout.php"> <img src="images/logout_ico.png" width="35px" height="35px" alt="logout"></a></td>
                </tr>
            </table>
        </div>
    </div>
    <div class='container'>
        <br>
        <h1>Sendbox</h1>
        <hr>
        <img src="images/send_Message.png" alt="Message" class="messageImg">
        <h2 style="color:dodgerblue;">Send a message!</h2>
    </div>
    <div class='container'>
        <br>
        <form action="contact_submit.php" method="POST">
            Email: <input type="email" name="email" style="padding: 2px;" value=" <?php echo $user_data['email']; ?>" required>
            <br>
            <br>
            <textarea style="padding: 5px;" rows="10" cols="50" name="comment" placeholder=" Enter text here..." required></textarea>
            <br>
            <button class="send-button" type="submit">Send</button>
        </form>
        <br><br><br><br><br><br>
    </div>
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
if (isset($_GET['success']) && $_GET['success'] == 0) {
    echo '<script>swal("Delete!", "Something goes wrong.", "warning");</script>';
    echo '<script>
                var url= document.location.href;
                window.history.pushState({}, "", url.split("?")[0]);
                </script>';
}
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<script>swal("Success!", "Your message has been send successfully.", "success");</script>';
    echo '<script>
                var url= document.location.href;
                window.history.pushState({}, "", url.split("?")[0]);
                </script>';
}
?>