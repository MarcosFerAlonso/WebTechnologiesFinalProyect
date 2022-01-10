<?php 
session_start();

	include("connection.php");
	include("functions.php");

    //redirection to log in
	$user_data = check_login($con);
 
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		if(isset($_POST['modifyUser'])) {
            $users_id=$_POST['users_id'];
            $user_name=$_POST['user_name'];
			$email=$_POST['email'];
            $password=$_POST['password'];
            $premium=$_POST['premium'];
            $ban=$_POST['ban'];
            if(!empty($user_name)) {
                $sql="UPDATE users SET user_name='$user_name' where users_id='$users_id'";
                if ($con->query($sql) === TRUE) {
                    echo "Record updated successfully";
                  } else {
                    echo "Error updating record: " . $con->error;
                  }
            }
            if(!empty($email)) {
                $sql="UPDATE users SET user_email='$email' where users_id='$users_id'";
                if ($con->query($sql) === TRUE) {
                    echo "Record updated successfully";
                  } else {
                    echo "Error updating record: " . $con->error;
                  }
            }
            if(!empty($password)) {
                $sql="UPDATE users SET user_password='$password' where users_id='$users_id'";
                if ($con->query($sql) === TRUE) {
                    echo "Record updated successfully";
                  } else {
                    echo "Error updating record: " . $con->error;
                  }
            }
            if($premium == 1 || $premium==0) {
                $sql="UPDATE users SET premium='$premium' where users_id='$users_id'";
                if ($con->query($sql) === TRUE) {
                    echo "Record updated successfully";
                  } else {
                    echo "Error updating record: " . $con->error;
                  }
            }

            if($ban == 1 || $ban==0) {
                $sql="UPDATE users SET banned='$ban' where users_id='$users_id'";
                if ($con->query($sql) === TRUE) {
                    echo "Record updated successfully";
                  } else {
                    echo "Error updating record: " . $con->error;
                  }
            }
		}
        
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="clientBanCSS.css">
	<title>Client Ban</title>
</head>
<body>
	<header id="main-header">
		
		<a id="logo-header" href="adminIndex.php">
			<span class="site-name">Films4U</span>
			<span class="site-desc">Admin view</span>
		</a> 
		<nav>
			<ul>
				<li><a href="adminIndex.php">Add Film</a></li>
				<li><a href="clientBan.php">Ban Client</a></li>
				<li><a href="filmRemove.php">Remove films</a></li>
				<li><a href="modifyFilms.php">Modify films</a></li>
			</ul>
		</nav>
	</header>
	<div id="box">
		<form method="POST">
            <input id="text" type="number" name="users_id" autofocus placeholder="Current user ID"><br><br>
            <input id="text" type="text" name="user_name" autofocus placeholder="New Users name">
            <input id="text" type="email" name="email" autofocus placeholder="New Users Email">
            <input id="text" type="text" name="password" autofocus placeholder="New Users Password">
            <input id="text" type="number" name="premium" autofocus placeholder="Set Premium">
            <input id="text" type="number" name="ban" autofocus placeholder="Set Ban">
			<input id="button" type="submit" name="modifyUser" value="Modify user"><br><br>
		</form>
	</div>
    <table>
    <tr>
        <th>Id</th>
        <th>User Email</th>
        <th>User Name</th>
        <th>Premium</th>
        <th>Banned</th>
    </tr>
    <?php
        $sql = "SELECT * FROM users";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["users_id"]. "</td><td>" . $row["user_email"] . "</td><td>"
            . $row["user_name"]. "</td><td>". $row["premium"]. "</td><td>". $row["banned"]. "</td> </tr>";
            }
            echo "</table>";
        } else { echo "0 results"; 
        }
    ?>
    </table>
</body>
</html>