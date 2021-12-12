<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <!-- Search-ico -->
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
                <form method="post">
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
        <h1>Home</h1>
        <hr>
    </div>
            <?php
            if (isset($_POST['search_author'])) {
                $author = $_POST['author'];
                $sql = "SELECT * FROM books where author = '$author'";
                $rez = mysqli_query($con, $sql);
                $i = 1;
                ?> 
                    <div class="container">
                    <h2>Searched: </h2>
                    <br>
                    <table class="user-table">
                        <tr>
                            <th>Nr. Book</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Publisher</th>
                            <th>Subject</th>
                            <th>Year</th>
                            <th>Pages</th>
                        </tr>
                <?php
                while ($row = mysqli_fetch_array($rez)) {
                    echo "<tr";
                    if ($i % 2 == 0)
                        echo " class=\"stil1\"";
                    echo "><td>" . $i . "</td>
                                <td>" . $row['title'] . "</td>
                                <td>" . $row['author'] . "</td>
                                <td>" . $row['publisher'] . "</td>
                                <td>" . $row['subject'] . "</td>
                                <td>" . $row['year'] . "</td>
                                <td>" . $row['nr_pages'] . "</td>
                                </tr>\n";
                    $i++;
                }
             } 
            ?></table> </div> <?php         
            ?>
           
        <div class="container">
        <br>
        <h2 class="glow">New Adds!</h2>
        <br>
        </div>
        <div class="flexbox-container">
        <?php
                 $sql="SELECT * FROM books";
                 $rez=mysqli_query ($con,$sql);
				while($row=mysqli_fetch_array($rez))
				{
                    ?>
					<div class="flexbox-item flexbox-item-1">
                    <img class="cover-image"src="covers/<?php echo $row['title'] ?>.jpg">
                    <div class="title-book"><?php echo $row['title']?></div>
                    <div class="title-book"><?php echo $row['price']?>$</div>
                        <form action="add_to_cart.php" method="POST">
                            <input type="hidden" name="id_user" value='<?php echo  $user_data['id_user'];?>'>
                            <input type="hidden" name="id_book" value='<?php echo $row['id_book'] ?>'>
                            <input type="hidden" name="title" value='<?php echo $row['title'] ?>'>
                            <input type="hidden" name="price" value='<?php echo $row['price'] ?>'>
                            <button type="submit" name="atc-btn" class="atc" id="atc-btn">Add to Cart</button>
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

<!-- Script message when user press add to cart button -->
<?php 
  if(!isset($_POST['search_author']))
  {
    if ( isset($_GET['success']) && $_GET['success'] == 1 )
    {
        echo '<script>swal("Good job!", "New book add to your cart!", "success");</script>';
        //Stergem raspunsul
        echo '<script>
        var url= document.location.href;
        window.history.pushState({}, "", url.split("?")[0]);
        </script>';
    }
    else if (isset($_GET['success']) && $_GET['success'] == 2)
    {
        echo '<script>swal("Warning!", "This book is already in your cart.", "warning");</script>';
        echo '<script>
        var url= document.location.href;
        window.history.pushState({}, "", url.split("?")[0]);
        </script>';
    }
  }
?>