<?php 
session_start();

	include("connection.php");
	include("functions.php");

    //redirection to log in
	$user_data = check_login($con);
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		if(isset($_POST['addfilm'])) {
			$title=$_POST['title'];
			$rating=$_POST['rating'];
			$description=$_POST['description'];
			$image=$_POST['image'];
			$trailer=$_POST['trailer'];
			$cost=$_POST['cost'];
			$genre=$_POST['genre'];
			$pegi=$_POST['pegi'];
			$outdated=$_POST['outdated'];
			$query = "insert into films(films_id,title,rating,description,image,trailer,cost,genre,pegi,outdated) values ('','$title','$rating','$description','$image','$trailer','$cost','$genre','$pegi','$outdated')";
			mysqli_query($con, $query);
			echo "Added succesfully";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="adminIndexCSS.css">
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
				<li><a href="filmRemove.php">Remove films</a></li>
				<li><a href="modifyFilms.php">Modify films</a></li>
			</ul>
		</nav>
	</header>
	<div id="box">
		<form method="POST">
            <input id="text" type="text"   name="title" autofocus placeholder="Film title"><br><br>
			<input id="text" type="number" step ="any" name="rating" autofocus placeholder="Rating"><br><br>
			<input id="text" type="text"   name="description" autofocus placeholder="Description"><br><br>
			<input id="text" type="text"   name="image" autofocus placeholder="Image"><br><br>
			<input id="text" type="text"   name="trailer" autofocus placeholder="Trailer"><br><br>
			<input id="text" type="number" step ="any" name="cost" autofocus placeholder="Cost"><br><br>
			<input id="text" type="number" name="genre" autofocus placeholder="Genre"><br><br>
			<input id="text" type="number" name="pegi" autofocus placeholder="Pegi"><br><br>
			<input id="text" type="number" name="outdated" autofocus placeholder="0 displayable 1 not displayable"><br><br>
			<input id="button" type="submit" name="addfilm" value="Add Film"><br><br>
		</form>
	</div>
</body>
</html>