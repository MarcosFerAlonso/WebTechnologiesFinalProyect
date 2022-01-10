<?php
session_start();

	include("connection.php");
	include("functions.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = mysqli_real_escape_string($con,$_POST['user_name']);
		$password = mysqli_real_escape_string($con,$_POST['user_password']);
        //Only with user_name for now 

		if(!empty($user_name) && !empty($password))
		{

			//read from database
			$query = "select * from users where user_name = '$user_name' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['user_password'] === $password)
					{

						$_SESSION['users_id'] = $user_data['users_id'];
						if($user_data['banned']==0) {
							if($user_data['users_id'] == 0) {
								header("Location: adminIndex.php");
								die;	
							} else{
								header("Location: index.php");
							}
							
							
						} else {
							echo "you have been banned from this webPage";
							die;	
						}
						
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="loginCSS.css">
    <title>Login</title>
</head>
<body>
	<form method="post">
		
		<div id="title">Login</div>

		<input id="text" type="text" name="user_name" autofocus placeholder="User name"><br><br>
		<input id="text" type="password" name="user_password" autofocus placeholder="Password"><br><br>

		<input id="button" type="submit" value="Login"><br><br>
		<img id="imgfb" src="facebook.png">
		<img id="img" src="google.png">
		<img id="img" src="twitter.png">
		<img id="img" src="discord.png">
		<p id="sg">Don't you have an account?
		<a id="link" href="signup.php">Signup</a>
		</p><br><br>
	</form> 
   
</body>
</html>
