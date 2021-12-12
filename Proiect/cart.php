<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cart</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
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
                <td><input type="text" placeholder="Search"></td>
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
    <div class="container">
        <h2>Your cart:</h2>
        <br>
        <table class="user-table">
            <tr>
                <th>Nr.</th>
                <th>Book id</th>
                <th>Title</th>
                <th>Price</th>
                <th colspan="2">Actions</th>
            </tr>
            <?php
            if (!empty($user_data['id_user'])) {
                $id_user = $user_data['id_user'];
                $sql1 = "SELECT * FROM cart where id_user = $id_user";
                $rez1 = mysqli_query($con, $sql1);
                $i = 1;
                while ($row = mysqli_fetch_array($rez1)) {
                    echo "<tr";
                    if ($i % 2 == 0)
                        echo " class=\"stil1\"";
                    echo ">
                        <td> $i </td>
						<td>" . $row['id_book'] . "</td>
						<td>" . $row['title'] . "</td>
						<td>" . $row['price'] . "$</td>";
            ?>

                    <form action="delete_cart_book.php" method="POST">
                        <input type="hidden" name="id_user" value='<?php echo  $user_data['id_user']; ?>'>
                        <input type="hidden" name="id_book" value="<?php echo $row['id_book'] ?>">
                        <td><button type="submit" class="generic-btn delete-btn">Delete</button></td>
                    </form>
                    <form action="buy.php" method="post">
                        <input type="hidden" name="id_user" value='<?php echo  $user_data['id_user']; ?>'>
                        <input type="hidden" name="id_book" value="<?php echo $row['id_book'] ?>">
                        <input type="hidden" name="title" value="<?php echo $row['title'] ?>">
                        <input type="hidden" name="price" value="<?php echo $row['price'] ?>">
                        <td><button type="submit" class="generic-btn buy-btn">Buy</button></td>
                    </form>

            <?php
                    echo "</tr>\n";
                    $i++;
                }
            } else {
                echo "<h2 style=\"text-align: center; color:red;\">Login to add and see your books in the cart.</h2>";
            }
            ?>
        </table>
    </div>
    <div class="container">
        <h2>Orders: </h2>
        <table class="user-table">
            <tr>
                <th>Nr. Book</th>
                <th>Title</th>
                <th>Status</th>
            </tr>
            <?php
            $id_user = $user_data['id_user'];
            $sql = "SELECT * FROM orders WHERE id_user=$id_user";
            $rez = mysqli_query($con, $sql);
            $i = 1;
            if (!empty($id_user)) {
                if ($rez->num_rows != 0) {
                    while ($row = mysqli_fetch_array($rez)) {
                        echo "<td>" . $i . "</td>
                                <td>" . $row['title'] . "</td>
                                <td style=\"color:red; \">" . $row['status'] . "</td>";
                        echo "</tr>\n";
                        $i++;
                    }
                } else {
                    echo "<h2 style=\"text-align: center; color:red;\">No books added.</h2>";
                }
            } else {
                echo "<h2 style=\"text-align: center; color:red;\">Login to see your orders.</h2>";
            }
            ?>
        </table>
    </div>
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
if (isset($_GET['success']) && $_GET['success'] == 0) {
    echo '<script>swal("Delete!", "You have deleted the book.", "warning");</script>';
    echo '<script>
                var url= document.location.href;
                window.history.pushState({}, "", url.split("?")[0]);
                </script>';
}
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<script>swal("Great job!", "You buyed a new book!", "success");</script>';
    echo '<script>
                var url= document.location.href;
                window.history.pushState({}, "", url.split("?")[0]);
                </script>';
}
?>