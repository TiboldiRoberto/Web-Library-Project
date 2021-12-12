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
            if(!empty($id_user))
            {

                //delete from database
                //$date = date("Y-m-d H:i:s");
                $query = "DELETE FROM users WHERE id_user='$id_user'";

                mysqli_query($con, $query);

                echo "You have deleted the user with id: $id_user";
                header("Location: form_delete.php?success=1");
                die;
            }
            else
            {
                echo "Please enter some valid information!";
            }
        }
        else {
            echo "No user found with id: $id_user";
            header("Location: form_delete.php?success=2");
        }
	}
?>