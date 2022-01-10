<?php 
session_start();

	include("connection.php");
	include("functions.php");

    //redirection to log in
	$user_data = check_login($con);
 
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		if(isset($_POST['banUser'])) {
			$email=$_POST['email'];
            $sql = "UPDATE users SET banned=1 WHERE user_email='$email'";

            if ($con->query($sql) === TRUE) {
              echo "Record updated successfully";
            } else {
              echo "Error updating record: " . $con->error;
            }
		}
        header("Location: clientBan.php");
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
				<li><a href="modifyClient.php">Modify Client</a></li>
				<li><a href="filmRemove.php">Remove films</a></li>
				<li><a href="modifyFilms.php">Modify films</a></li>
			</ul>
		</nav>
	</header>
	<div id="box">
		<form method="POST">
            <input id="text" type="email" name="email" autofocus placeholder="Users Email"><br><br>
			<input id="button" type="submit" name="banUser" value="Ban user"><br><br>
		</form>
	</div>
    <table>
    <tr>
        <th>Id</th>
        <th>User Email</th>
        <th>User Name</th>
        <th>banned</th>
    </tr>
    <?php
        $sql = "SELECT * FROM users";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["users_id"]. "</td><td>" . $row["user_email"] . "</td><td>"
            . $row["user_name"]. "</td><td>". $row["banned"]. "</td> </tr>";
            }
            echo "</table>";
        } else { echo "0 results"; 
        }
    ?>
    </table>
</body>
</html>