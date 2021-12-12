<?php 
	include("connection.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$id_book = $_POST['id_book'];

        $query = "SELECT * from books where id_book = '$id_book' limit 1";
	    $result = mysqli_query($con, $query);
        // $c_result = $result->num_rows ? 'true' : 'false';
        // echo $c_result;
        if($result->num_rows != 0)
        {
            $title = $_POST['title'];
            $author = $_POST['author'];
            $publisher = $_POST['publisher'];
            $subject = $_POST['subject'];
            $year = $_POST['year'];
            $nr_pages = $_POST['nr_pages'];

            //save to database
            //$date = date("Y-m-d H:i:s");
            $query = "UPDATE books set title='$title',author='$author',publisher='$publisher',subject='$subject', year='$year', nr_pages='$nr_pages' WHERE id_book='$id_book'";

            mysqli_query($con, $query);

            echo "Book  with id $id_book has been updated";
            header("Location: form_insert.php?success=11");
            die;
        }
        else {
            echo "No book found with id: $id_book";
        }
	}
?>