<?php 
    session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
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
        <h1>Account</h1>
        <hr>
    </div>
    <div class="container">
        <h2>Your Books: </h2>
        <table class="user-table">
            <tr>
                <th>Nr. Book</th>
                <th>Title</th>
                <th>Status</th>
                <th>Start date</th>
                <th>Expire date</th>
                <th>Read</th>
            </tr>
            <?php
            $id_user = $user_data['id_user'];
            $sql = "SELECT * FROM borrowed WHERE id_user=$id_user";
            $rez = mysqli_query($con, $sql);
            $i = 1;
            if(!empty($id_user))
            {
                if($rez->num_rows != 0)
                {
                    while ($row = mysqli_fetch_array($rez)) {
                        echo "<td>" . $i . "</td>
                                <td>" . $row['title'] . "</td>
                                <td>" . $row['status'] . "</td>
                                <td>" . $row['start_date'] . "</td>
                                <td style=\"color:red;\">" . $row['expire_date'] . "</td>";
                                if($row['status']=="paid")
                                {
                                    ?> 
                                    <td><a class="generic-btn buy-btn" style="text-decoration: none;" href="pdf/<?php echo $row['title'] ?>.pdf">Read</a></td>
                                    <?php
                                }
                                echo"</tr>\n";
                        $i++;
                    }
                }
                else 
                {
                echo "<h2 style=\"text-align: center; color:red;\">No books added.</h2>";
                }
            }
            else 
            {
                echo "<h2 style=\"text-align: center; color:red;\">No books added.</h2>";
            }
            ?>
        </table>
    </div>

    <br><br><br><br><br><br><br>
    <footer>
            <div class="container">
            <div class="footer-text">
                &#169 2021 Copyright. Designed by Tiboldi Roberto.
            </div>    
        </div> 
    </footer>
</body>

</html>