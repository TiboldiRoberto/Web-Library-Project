<?php 
	include("connection.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
        $email = mysqli_real_escape_string($con,$_POST['email']);
        $query = "SELECT * from users where email = '$email'";
	    $result = mysqli_query($con, $query);
        while($row=mysqli_fetch_array($result))
				{
                    $id_user = $row['id_user'];
                }
		
		$comment =  mysqli_real_escape_string($con,$_POST['comment']);
        $post_date = date("Y-m-d H:i:s");

        $query = "INSERT Into comments (id_user,email,comment,post_date) VALUES('$id_user','$email','$comment','$post_date')";
        mysqli_query($con, $query);
        header("Location:contact.php?success=1");
    }
    else
    {
        header("Location:contact.php?success=0");
    }
