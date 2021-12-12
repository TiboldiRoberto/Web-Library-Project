<?php 
	include("connection.php");

	if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES['cover_image']) && isset($_FILES['pdf'])) {

		$title = $_POST['title'];
		$author = $_POST['author'];
        $publisher = $_POST['publisher'];
		$subject = $_POST['subject'];
		$year = $_POST['year'];
		$nr_pages = $_POST['nr_pages'];
		$price = $_POST['price'];
		$pdf = $_FILES['pdf'];

		echo "<pre>";
		print_r($_FILES['cover_image']);
		echo "</pre>";

		// Verificam pdf-ul
		echo "<pre>";
		print_r($_FILES['pdf']);
		echo "</pre>";
		
		$pdf_name = $_FILES['pdf']['name'];
		$tmp_name1 = $_FILES['pdf']['tmp_name'];
		$error1 = $_FILES['pdf']['error'];
		
		$img_name = $_FILES['cover_image']['name'];
		$img_size = $_FILES['cover_image']['size'];
		$tmp_name = $_FILES['cover_image']['tmp_name'];
		$error = $_FILES['cover_image']['error'];
		echo $error;
		if ($error == 0 && $error1 == 0) {
			if ($img_size > 1250000) {
				$em = "Sorry, your file is too large.";
				header("Location: index.php?error=$em");
			}else {
				$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
				$img_ex_lc = strtolower($img_ex);
	
				$allowed_exs = array("jpg", "jpeg", "png"); 
	
				if (in_array($img_ex_lc, $allowed_exs)) {
					// $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
					$img_upload_path = 'covers/'.$title.'.'.$img_ex_lc;
					move_uploaded_file($tmp_name, $img_upload_path);
					$img_new_name = $title.'.'.$img_ex_lc;
					
						$allowed_books_exs= array("pdf");
						$pdf_ex = pathinfo($pdf_name, PATHINFO_EXTENSION);
						$pdf_ex_lc = strtolower($pdf_ex);
						if (in_array($pdf_ex_lc, $allowed_books_exs)) {
								$pdf_upload_path = 'pdf/'.$title.'.'.$pdf_ex_lc;
								move_uploaded_file($tmp_name1, $pdf_upload_path);
								$pdf_new_name = $title.'.'.$pdf_ex_lc;
						}
						else{
								echo "This type of file is not allowed";
							}
						

					if(!empty($title) && !empty($author) && !is_numeric($subject))
					{

					//save to database
						$date = date("Y-m-d H:i:s");
						$query = "insert into books (title,author,publisher,subject,year,nr_pages,insert_date,price,cover_image,pdf) values ('$title','$author','$publisher','$subject','$year','$nr_pages','$date','$price','$img_new_name','$pdf_new_name')";

						mysqli_query($con, $query);

						// echo "New book has been added!";
						// header("Location: form_orders.php");
						header("Location: form_insert.php?success=11");
						die;
					}
					else
						{
							echo "Please complete required fields!";
						}
				}else {
					$em = "You can't upload files of this type";
					header("Location: index.php?error=$em");
				}
			}
		}else {
			$em = "unknown error occurred!";
			header("Location: index.php?error=$em");
		}
	
	}else {
		header("Location: index.php");
	}
?>