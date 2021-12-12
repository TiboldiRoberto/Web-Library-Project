<?php 
	include("connection.php");
    if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$id_user = $_POST['id_user'];
		$id_book = $_POST['id_book'];
		
        $title = $_POST['title'];
        
		//save to database
        $start_date = date("Y-m-d");
        // echo $start_date . "\n";

        $expire_date = new DateTime($start_date);
        $expire_date->modify('+1 month');
        $expire_date = $expire_date->format("Y-m-d");
        // echo $expire_date->format('Y-m-d H:i:s') . "\n";

        $status = "paid";
		$query = "INSERT INTO borrowed (id_user,id_book,title,status,start_date,expire_date) values ('$id_user','$id_book','$title','$status','$start_date','$expire_date')";

		mysqli_query($con, $query);

        //delete the book from the cart

        $query = "SELECT * FROM orders WHERE id_user='$id_user' AND id_book='$id_book' limit 1";
        $result = mysqli_query($con, $query);
        // $c_result = $result->num_rows ? 'true' : 'false';
        // echo $c_result;
        if($result->num_rows != 0)
		{
            $query = "DELETE FROM orders WHERE id_user='$id_user' AND id_book='$id_book'";

				mysqli_query($con, $query);
        }
        else{
            echo "Something goes wrong";
        }

        echo "You accept an order!";
        header("Location: form_orders.php?success=1");
		die;
	}
?>