<?php 
session_start();

	include("connection.php");
	include("functions.php");

    //redirection to log in
	$user_data = check_login($con);
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		if(isset($_POST['removefilm'])) {
			$film_id=$_POST['film_id'];
            $sql = "DELETE FROM films WHERE films_id='$film_id'";
            if (mysqli_query($con, $sql)) {
                echo "Record deleted successfully";
            } else {
                echo "Error deleting record: " . mysqli_error($conn);
            }
        }
        header("Location: filmRemove.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="clientBanCSS.css">
	<title>Admin add film</title>
</head>
<body>
	<header id="main-header">
		
		<a id="logo-header" href="adminIndex.php">
			<span class="site-name">Films4U</span>
			<span class="site-desc">Admin view</span>
		</a> 
		<nav>
			<ul>
				<li><a href="clientBan.php">Ban Client</a></li>
				<li><a href="modifyClient.php">Modify Client</a></li>
				<li><a href="modifyFilms.php">Modify films</a></li>
				<li><a href="adminIndex.php">Add films</a></li>
			</ul>
		</nav>
	</header>
	<div id="box">
		<form method="POST">
            <input id="text" type="number" name="film_id" autofocus placeholder="Film id"><br><br>
			<input id="button" type="submit" name="removefilm" value="Remove Film"><br><br>
		</form>
	</div>
    <table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Trailer</th>
        <th>Image</th>
    </tr>
    <?php
        $sql = "SELECT * FROM films";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["films_id"]. "</td><td>" . $row["title"] . "</td><td>"
            . $row["trailer"]. "</td><td>". $row["image"]. "</td> </tr>";
            }
            echo "</table>";
        } else { echo "0 results"; 
        }
    ?>
    </table>
</body>
</html>