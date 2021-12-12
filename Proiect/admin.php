<!DOCTYPE html>
<html> 
    <head>
        <title>Login</title>
    </head>
    <style type="text/css">
        #login {
            text-align: center;
            color: darkslategrey;
            font-size: 1.5em;
            font-family: sans-serif;
            margin: 15px 0px;
        }

        .text{
            display: block;
            margin: 0px auto;
            height: 25px;
            border-radius: 5px;
            padding: 4px;
            border: 2px solid black;
        }

        #button{
            display: block;
            margin-right: auto;
            margin-left: auto;
            padding: 10px;
            width: 100px;
            color: white;
            background-color: dodgerblue;
            border: none;
            cursor: pointer;
            border-radius: 10px;
            outline: none;
        }
        
        #box {
            width: 300px;
            height: 320px;
            position:absolute;
            top:50%;
            left:50%;
            margin-top:-170px; /* this is half the height of your div*/  
            margin-left:-160px; /*this is half of width of your div*/
            background-color: white;
            border-radius: 50px;
            border: 5px solid black;
        }

        a {
            display: block;
            text-align: center;
            margin: 15px auto;
            font-family: sans-serif;
            font-size: 1.1em;
            color: darkslategrey;
            text-decoration: none;
        }
    </style>
    <body>
        <div id= "box">
            <form method="POST">
                <div id="login">Admin Login</div>
                <br>
                <input class="text" type="text" name="username" placeholder="Username" required><br>
			    <input class="text" type="password" name="password" placeholder="Password" required><br>
                <?php 
    session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$username = mysqli_real_escape_string($con,$_POST['username']);
		$password = mysqli_real_escape_string($con,$_POST['password']);
        $password = md5($password);

		if(!empty($username) && !empty($password))
		{

			//read from database
			$query = "SELECT * FROM administrators WHERE username = '$username' AND password='$password' limit 1";
			$result = mysqli_query($con, $query);

				if(mysqli_num_rows($result) > 0)
				{
					$_SESSION['username'] = $username;
					header("Location: admin_panel.php");
					
				}
                else
                {
                    //echo'<script>alert("Wrong Admin Details!")</script>';
                    echo "<p style=\"color:red; text-align: center;\" >Wrong username or password!</p>";
                }

		}else
		{
			echo "<p style=\"color:red; text-align: center;\" >Wrong username or password!</p>";
		}
	}
?>
			    <input id="button" type="submit" value="Login">
            </form>
                <a href="index.php">Home page</a>
        </div>
    </body>
</html>