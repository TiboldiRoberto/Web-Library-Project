<?php 
	include("connection.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$username = mysqli_real_escape_string($con,$_POST['username']);
		$password = mysqli_real_escape_string($con,$_POST['password']);
		$password = md5($password);
        $email = $_POST['email'];

		$query = "SELECT * from users where email = '$email'";
	    $result = mysqli_query($con, $query);

		if($result->num_rows == 0)
		{
			if(!empty($username) && !empty($password) && !is_numeric($username))
			{

				//save to database
				$date = date("Y-m-d H:i:s");
				$query = "insert into users (username,password,email,date) values ('$username','$password','$email','$date')";

				mysqli_query($con, $query);

				header("Location: form_insert.php?success=1");
				die;
			}else
			{
				echo '<script>alert("Please enter some valid information!")</script>';
			}
		}
		else {
			header("Location: form_insert.php?success=2");
		}
	}
?>