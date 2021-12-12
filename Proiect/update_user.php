<?php 
	include("connection.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$id_user = $_POST['id_user'];

        $query = "SELECT * from users where id_user = '$id_user' limit 1";
	    $result = mysqli_query($con, $query);
        // $c_result = $result->num_rows ? 'true' : 'false';
        // echo $c_result;
        if($result->num_rows != 0)
        {
            $username = $_POST['username'];
            $email = $_POST['email'];

            if(!is_numeric($username))
            {
                //save to database
                //$date = date("Y-m-d H:i:s");
                $query = "UPDATE users set username= '$username', email='$email' WHERE id_user='$id_user'";

                mysqli_query($con, $query);

                echo "User with id $id_user has been updated";
                header("Location: form_update.php?success=1");
                die;
            }else
            {
                echo "Something goes wrong!";
            }
        }
        else {
            echo "No user found with id: $id_user";
        }
	}
?>