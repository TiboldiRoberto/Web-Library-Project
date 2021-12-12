<?php 
	include("connection.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
        $id_book = $_POST['id_book'];
        $id_user = $_POST['id_user'];

        $query = "SELECT * from orders where id_book = '$id_book' AND id_user = '$id_user' limit 1";
	    $result = mysqli_query($con, $query);
        // $c_result = $result->num_rows ? 'true' : 'false';
        // echo $c_result;
        if($result->num_rows != 0)
        {
            if(!empty($id_user) && !empty($id_book))
            {

                //delete from database
                //$date = date("Y-m-d H:i:s");
                $query = "DELETE FROM orders WHERE id_book = '$id_book' AND id_user='$id_user'";

                mysqli_query($con, $query);

                echo "You have deleted the order!";
                header("Location: form_orders.php?success=0");
                die;
            }
            else
            {
                echo "Please enter some valid information(Problems with book, user, id!";
                header("Location: form_orders.php?success=2");
            }
        }
        else {
            echo "No order found!";
        }
	}
