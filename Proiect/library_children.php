<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Library</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <!-- Search icon -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php
    include "navbar.php";
    ?>
    <div class="banner">
        <img src="banners/b4.jpg" class="banner-img">
        <table class="search" id="search-table">
            <tr>
                <form method="post" action="index.php">
                    <td><input type="text" placeholder="Search Author" name="author" required></td>
                    <td>
                        <button type="submit" name="search_author" style="border: none; background: none; outline: none;">
                            <img src="images/search_ico.png" width="40px" height="40px" style="margin-top: 2px;">
                        </button>
                    </td>
                </form>
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
        <h1>Library</h1>
        <hr>
    </div>

    <div class='container'>
        <?php include("library_carousel.php"); ?>
    </div>

    <div class="container">
        <h2 class="glow">Children</h2>
        <br>
    </div>
    <div class="flexbox-container">
        <?php
        $sql = "SELECT * FROM books WHERE subject ='Children'";
        $rez = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($rez)) {
        ?>
            <div class="flexbox-item flexbox-item-1">
                <img class="cover-image" src="covers/<?php echo $row['title'] ?>.jpg">
                <div class="title-book"><?php echo $row['title'] ?></div>
                <div class="title-book"><?php echo $row['price'] ?>$</div>
                <form action="add_to_cart.php" method="POST">
                    <input type="hidden" name="id_user" value='<?php echo  $user_data['id_user']; ?>'>
                    <input type="hidden" name="id_book" value='<?php echo $row['id_book'] ?>'>
                    <input type="hidden" name="title" value='<?php echo $row['title'] ?>'>
                    <button type="submit" class="atc">Add to Cart</button>
                </form>
            </div>
        <?php
        }
        ?>
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

<!-- Subject Carousel -->
<script>
    var span = document.getElementsByTagName('span');
    var item = document.getElementsByClassName('carousel-item');
    var l = 0;
    span[1].onclick = () => {
        l++;
        for (var i of item) {
            if (l == 0) {
                i.style.left = "0px";
            }
            if (l == 1) {
                i.style.left = "-140px";
            }
            if (l == 2) {
                i.style.left = "-280px";
            }
            if (l == 3) {
                i.style.left = "-420px";
            }
            if (l == 4) {
                i.style.left = "-560px";
            }
            if (l > 4) {
                l = 4;
            }
        }
    }
    span[0].onclick = () => {
        l--;
        for (var i of item) {
            if (l == 0) {
                i.style.left = "0px";
            }
            if (l == 1) {
                i.style.left = "-140px";
            }
            if (l == 2) {
                i.style.left = "-280px";
            }
            if (l == 3) {
                i.style.left = "-420px";
            }
            if (l == 4) {
                i.style.left = "-560px";
            }
            if (l > 4) {
                l = 4;
            }
        }
    }
</script>