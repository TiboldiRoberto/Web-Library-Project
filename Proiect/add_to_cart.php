<?php
include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST['id_user'])) {
        if (!empty($_POST['id_book']) && !empty($_POST['title'])) {
            $id_user = $_POST['id_user'];
            $id_book = $_POST['id_book'];
            $title = $_POST['title'];
            $price = $_POST['price'];
            if (!check_cart($con, $id_user, $id_book)) {
                //save to database
                //$date = date("Y-m-d H:i:s");
                $query = "insert into cart (id_user,id_book,title,price) values ('$id_user','$id_book','$title','$price')";

                if (mysqli_query($con, $query)) {
                    header("Location: index.php?success=1");
                    //echo "New book add to cart!";
                }
            } else {
                header("Location: index.php?success=2");
                // header( "refresh:1; url=index.php" ); 
            }
        } else {
            echo "Something goes wrong!";
        }
    } else {
        // echo "You are not logged in!";
        // header( "refresh:1; url=login.php" ); 
        header("Location:login.php");
    }
}
?>
