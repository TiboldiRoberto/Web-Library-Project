<?php
include("connection.php");
include("functions.php");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Page</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Sweet Box Message Alert! -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <?php
    include "admin_menu.php";
    ?>
    <div class="container">
        <h2>Orders: </h2>
        <br>
        <table class="user-table">
            <tr>
                <th>Nr. Book</th>
                <th>User Id</th>
                <th>Book Id</th>
                <th>Title</th>
                <th>Status</th>
                <th>Start date</th>
                <th>Expire date</th>
                <th colspan="2">Actions</th>
            </tr>
            <?php
            check_expire_date($con);
            $sql = "SELECT * FROM orders";
            $rez = mysqli_query($con, $sql);
            $i = 1;
            if ($rez->num_rows != 0) {
                while ($row = mysqli_fetch_array($rez)) {
                    echo "<td>" . $i . "</td>
                            <td>" . $row['id_user'] . "</td>
                            <td>" . $row['id_book'] . "</td>
                            <td>" . $row['title'] . "</td>
                            <td>" . $row['status'] . "</td>
                            <td>" . $row['start_date'] . "</td>
                            <td>" . $row['expire_date'] . "</td>";
            ?>
                    <form action="add_to_borrowed.php" method="POST">
                        <input type="hidden" name="id_user" value='<?php echo $row['id_user'] ?>'>
                        <input type="hidden" name="id_book" value='<?php echo $row['id_book'] ?>'>
                        <input type="hidden" name="title" value="<?php echo $row['title'] ?>">
                        <td><button type="submit" class="generic-btn buy-btn">Accept</button></td>
                    </form>
                    <form action="delete_order.php" method="POST">
                        <input type="hidden" name="id_user" value='<?php echo  $row['id_user']; ?>'>
                        <input type="hidden" name="id_book" value="<?php echo $row['id_book'] ?>">
                        <input type="hidden" name="title" value="<?php echo $row['title'] ?>">
                        <td><button type="submit" class="generic-btn delete-btn">Delete</button></td>
                    </form>
            <?php
                    echo "</tr>\n";
                    $i++;
                }
            } else {
                echo "No orders.";
            }
            ?>
        </table>
    </div>
    <div class="container">
        <h2>Accepted orders: </h2>
        <br>
        <table class="user-table">
            <tr>
                <th>Nr. Book</th>
                <th>Title</th>
                <th>Status</th>
                <th>Start date</th>
                <th>Expire date</th>
            </tr>
            <?php
            $sql = "SELECT * FROM borrowed";
            $rez = mysqli_query($con, $sql);
            $i = 1;
            if ($rez->num_rows != 0) {
                while ($row = mysqli_fetch_array($rez)) {
                    echo "<td>" . $i . "</td>
                            <td>" . $row['title'] . "</td>
                            <td>" . $row['status'] . "</td>
                            <td>" . $row['start_date'] . "</td>
                            <td>" . $row['expire_date'] . "</td>";
                    echo "</tr>\n";
                    $i++;
                }
            } else {
                echo "No orders accepted.";
            }
            ?>
        </table>
    </div>
    <br><br><br>
    <br><br><br>
    <br><br><br>
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
    echo '<script>swal("Delete!", "You have deleted the order!", "warning");</script>';
    echo '<script>
                var url= document.location.href;
                window.history.pushState({}, "", url.split("?")[0]);
                </script>';
}
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<script>swal("Great job!", "You accept an order!", "success");</script>';
    echo '<script>
                var url= document.location.href;
                window.history.pushState({}, "", url.split("?")[0]);
                </script>';
}
if (isset($_GET['success']) && $_GET['success'] == 2) {
    echo '<script>swal("Warning!", "Please enter some valid information!", "info");</script>';
    echo '<script>
                var url= document.location.href;
                window.history.pushState({}, "", url.split("?")[0]);
                </script>';
}
?>