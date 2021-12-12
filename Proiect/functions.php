<?php

// Check if a user is login
function check_login($con)
{

	if (isset($_SESSION['username'])) {

		$username =  mysqli_real_escape_string($con,$_SESSION['username']);
		$query = "select * from users where username = '$username' limit 1"; // verificam in baza de date dupa username

		$result = mysqli_query($con, $query); //citim din baza de date 
		if ($result && mysqli_num_rows($result) > 0) {
			$user_data = mysqli_fetch_assoc($result);  //assoc = associative array
			return $user_data;
		}
	} else {
		return;
	}

	//redirect to login
	header("Location: index.php");
	die;
}

function check_admin_login($con)
{

	if (isset($_SESSION['username'])) {

		$username = $_SESSION['username'];
		$query = "select * from administrators where username = '$username' limit 1"; // verificam in baza de date dupa username

		$result = mysqli_query($con, $query); //citim din baza de date 
		if ($result && mysqli_num_rows($result) > 0) {
			$user_data = mysqli_fetch_assoc($result);  //assoc = associative array
			return $user_data;
		}
	} else {
		return;
	}

	//redirect to login
	header("Location: index.php");
	die;
}

function check_expire_date($con)
{
	$query = "SELECT * from borrowed";
	$result = mysqli_query($con, $query);
	//$c_result = $result->num_rows ? 'true' : 'false';
	// echo $c_result;
	if ($result->num_rows != 0) {
		while ($row = mysqli_fetch_array($result)) {
			$current_date = date("Y-m-d");
			$expire_date = $row['expire_date'];
			if ($current_date == $expire_date) {

				//UPDATE STATUS
				$query = "UPDATE borrowed set status='expired' WHERE expire_date ='$current_date'";
           		mysqli_query($con, $query);
				//DELETE FROM BORROWED
				// $query = "DELETE FROM borrowed WHERE expire_date ='$current_date'";
				// mysqli_query($con, $query);
			}
		}
	}
}

function check_cart($con,$id_user,$id_book)
{
	$query = "SELECT * from cart WHERE id_user='$id_user' AND id_book='$id_book'";
	$result = mysqli_query($con, $query);
	return $result->num_rows;
}
