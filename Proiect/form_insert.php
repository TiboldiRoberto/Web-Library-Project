<?php
include("connection.php");
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
        <br>
        <h1>Insert Users</h1>
        <form action="insert_user.php" method="POST">
            <table class="user-table" style="width:100%; text-align: center; ">
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Email</th>
                </tr>
                <tr>
                    <td><input type="text" name="username" required></td>
                    <td><input type="password" name="password" required></td>
                    <td><input type="email" name="email" required></td>
                </tr>

                <tr>
                    <td></td>
                    <td style="padding-top: 10px;"><input type="submit" value="Insert" class="generic-btn buy-btn"></td>
                </tr>
            </table>
        </form>
    </div>

    <div class="container">
        <br>
        <h1>Insert Books</h1>
        <form action="insert_books.php" method="POST" enctype="multipart/form-data">
            <table class="user-table" style="width:100%; text-align: center;">
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Publisher</th>
                </tr>
                <tr>
                    <td><input type="text" name="title"></td>
                    <td><input type="text" name="author"></td>
                    <td><input type="text" name="publisher"></td>
                </tr>
                <tr>
                    <th>Subject</th>
                    <th>Year</th>
                    <th>Pages</th>
                </tr>
                <tr>
                    <td><input type="text" name="subject"></td>
                    <td><input type="number" name="year"></td>
                    <td><input type="number" name="nr_pages"></td>
                </tr>
                <tr>
                    <th>Images</th>
                    <th>Price</th>
                    <th>Pdf</th>
                </tr>

                <tr>
                    <td><input style="width: 180px;" type="file" name="cover_image"></td>
                    <td><input type="number" name="price"></td>
                    <td><input style="width: 180px;" type="file" name="pdf"></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="padding-top: 10px;"><input type="submit" value="Insert" class="generic-btn buy-btn"></td>
                    <td></td>
                </tr>
            </table>
        </form>
    </div>

    <br><br><br>
    <br><br><br>
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
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<script>swal("Great job!", "You added a new user!", "success");</script>';
    echo '<script>
                var url= document.location.href;
                window.history.pushState({}, "", url.split("?")[0]);
                </script>';
}
if (isset($_GET['success']) && $_GET['success'] == 2) {
    echo '<script>swal("Info!", "Someone was already registred with this email!", "info");</script>';
    echo '<script>
                var url= document.location.href;
                window.history.pushState({}, "", url.split("?")[0]);
                </script>';
}
if (isset($_GET['success']) && $_GET['success'] == 11) {
    echo '<script>swal("Great job!", "You added a new book!", "success");</script>';
    echo '<script>
                var url= document.location.href;
                window.history.pushState({}, "", url.split("?")[0]);
                </script>';
}
?>