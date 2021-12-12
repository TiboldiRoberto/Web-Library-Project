<?php 
	include("connection.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
        $id_book = $_POST['id_book'];
        $id_user = $_POST['id_user'];

        $query = "SELECT * from cart where id_book = '$id_book' AND id_user = '$id_user' limit 1";
	    $result = mysqli_query($con, $query);
        // $c_result = $result->num_rows ? 'true' : 'false';
        // echo $c_result;
     
        if($result->num_rows != 0)
        {
            if(!empty($id_user) && !empty($id_book))
            {

                //delete from database
                //$date = date("Y-m-d H:i:s");
                $query = "DELETE FROM cart WHERE id_book = '$id_book' AND id_user='$id_user'";

                //mysqli_query($con, $query);
                $result = mysqli_query($con, $query);
            
                echo "You have deleted the book!";
                header( "Location: cart.php?success=0" ); 
                die;
            }
            else
            {
                echo "Please enter some valid information(Problems with book, user, id)!";
            }
        }
        else {
            echo "No book found!";
        }
	}
