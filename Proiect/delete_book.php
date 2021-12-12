<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	//something was posted
	$id_book = $_POST['id_book'];

	//verify if id_book is in the databease
	$query = "SELECT * from books where id_book= '$id_book' limit 1";
	$result = mysqli_query($con, $query);

	if ($result->num_rows) {
		if (!empty($id_book)) {
			//delete from database
			//$date = date("Y-m-d H:i:s");
			$query = "DELETE FROM books WHERE id_book='$id_book'";

			mysqli_query($con, $query);

			echo "You have deleted the book with id: $id_book";
			header("Location: form_delete.php?success=11");
			die;
		} else {
			echo "Please enter some valid information!";
		}
	} else {
		echo "No book found with id: $id_book";
		header("Location: form_delete.php?success=22");
	}
}
