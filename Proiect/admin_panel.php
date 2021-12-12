<?php 
	session_start();
    include("connection.php");
    include("functions.php");

	$user_data = check_login($con);

	if(empty($user_data['username']))
	{
		header("Location: admin.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="/your-path-to-fontawesome/css/all.css" rel="stylesheet">
</head>
<body>

<?php 
include "admin_menu.php"; 
?>
    <div class='container'>
        <br>
        <h1>Books List</h1>
    </div>
    <div class="container">
    <table class="user-table">
		<tr>
			<th>Book Id</th>
			<th>Title</th>
			<th>Author</th>
			<th>Publisher</th>
			<th>Subject</th>
			<th>Year</th>
			<th>Pages</th>
			<th>Date</th>
		</tr>
			<?php
                 $sql="SELECT * FROM books";
                 $rez=mysqli_query ($con,$sql);
				$i=1;
				while($row=mysqli_fetch_array($rez))
				{
					echo"<tr";
						if($i%2==0)
							echo" class=\"stil1\"";
						echo">
						<td>".$row['id_book']."</td>
						<td>".$row['title']."</td>
						<td>".$row['author']."</td>
						<td>".$row['publisher']."</td>
						<td>".$row['subject']."</td>
						<td>".$row['year']."</td>
						<td>".$row['nr_pages']."</td>
						<td>".$row['insert_date']."</td>
						</tr>\n";
					$i++;
				}
			?>	
</table>
<br>
<br>
        <h1>Users List</h1>
        <table class="user-table">
		<tr>
			<th>User Id</th>
			<th>Username</th>
			<th>email</th>
			<th>date</th>
		</tr>
			<?php
                 $sql1="SELECT * FROM users";
                 $rez1=mysqli_query ($con,$sql1);
				$i=1;
				while($row=mysqli_fetch_array($rez1))
				{
					echo"<tr";
						if($i%2==0)
							echo" class=\"stil1\"";
						echo">
						<td>".$row['id_user']."</td>
						<td>".$row['username']."</td>
						<td>".$row['email']."</td>
						<td>".$row['date']."</td>
						</tr>\n";
					$i++;
				}
			?>	
</table>
<br>
<br>
        <h1>Comments</h1>
			<?php
                 $sql1="SELECT * FROM comments";
                 $rez1=mysqli_query ($con,$sql1);
				while($row=mysqli_fetch_array($rez1))
				{
					echo "<p class=\"email-cmt\">".$row['email']."</p>";
					echo "<p class=\"date-cmt\">".$row['post_date']."</p>";
					echo "<p class=\"comment-box\">".$row['comment']."</p>";
				}
			?>	
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