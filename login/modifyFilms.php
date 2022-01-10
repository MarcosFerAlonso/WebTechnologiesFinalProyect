<?php 
session_start();

	include("connection.php");
	include("functions.php");

    //redirection to log in
	$user_data = check_login($con);
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		if(isset($_POST['modifyfilm'])) {
			$film_id=$_POST['film_id'];
            $title=$_POST['title'];
            $Rating=$_POST['Rating'];
            $description=$_POST['description'];
            $image=$_POST['image'];
            $trailer=$_POST['trailer'];
            $cost=$_POST['cost'];
            $genre=$_POST['genre'];
            $pegi=$_POST['pegi'];
            $outdated=$_POST['outdated'];
            if(!empty($title)) {
                $sql="UPDATE films SET title='$title' where films_id='$film_id'";
                if ($con->query($sql) === TRUE) {
                    echo "Record updated successfully";
                  } else {
                    echo "Error updating record: " . $con->error;
                  }
            }
            if($Rating>= 0) {
                $sql="UPDATE films SET rating='$Rating' where films_id='$film_id'";
                if ($con->query($sql) === TRUE) {
                    echo "Record updated successfully";
                  } else {
                    echo "Error updating record: " . $con->error;
                  }
            }
            if(!empty($description)) {
                $sql="UPDATE films SET description='$description'  where films_id='$film_id'";
                if ($con->query($sql) === TRUE) {
                    echo "Record updated successfully";
                  } else {
                    echo "Error updating record: " . $con->error;
                  }
            }
            if(!empty($image)) {
                $sql="UPDATE films SET image='$image'  where films_id='$film_id'";
                if ($con->query($sql) === TRUE) {
                    echo "Record updated successfully";
                  } else {
                    echo "Error updating record: " . $con->error;
                  }
            }
            if(!empty($trailer)) {
                $sql="UPDATE films SET trailer='$trailer' where films_id='$film_id'";
                if ($con->query($sql) === TRUE) {
                    echo "Record updated successfully";
                  } else {
                    echo "Error updating record: " . $con->error;
                  }
            }
            if($cost >=0 ) {
                $sql="UPDATE films SET cost='$cost'  where films_id='$film_id'";
                if ($con->query($sql) === TRUE) {
                    echo "Record updated successfully";
                  } else {
                    echo "Error updating record: " . $con->error;
                  }
            }
            if($genre >= 0) {
                $sql="UPDATE films SET genre='$genre'  where films_id='$film_id'";
                if ($con->query($sql) === TRUE) {
                    echo "Record updated successfully";
                  } else {
                    echo "Error updating record: " . $con->error;
                  }
            }
            if($pegi>=0) {
                $sql="UPDATE films SET pegi='$pegi'  where films_id='$film_id'";
                if ($con->query($sql) === TRUE) {
                    echo "Record updated successfully";
                  } else {
                    echo "Error updating record: " . $con->error;
                  }
            }
            if($outdated >= 0) {
                $sql="UPDATE films SET outdated='$outdated' where films_id='$film_id'";
                if ($con->query($sql) === TRUE) {
                    echo "Record updated successfully";
                  } else {
                    echo "Error updating record: " . $con->error;
                  }
            }
 
        }
        header("Location: modifyFilms.php");
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
				<li><a href="filmRemove.php">Remove films</a></li>
				<li><a href="adminIndex.php">Add films</a></li>
			</ul>
		</nav>
	</header>
	<div id="box">
		<form method="POST">
            <input id="text" type="number" name="film_id" autofocus placeholder="Film id"><br><br>
            <input id="text" type="text" name="title" autofocus placeholder="Film title">
            <input id="text" type="number" step="any" name="Rating" autofocus placeholder="New film rating">
            <input id="text" type="text" name="description" autofocus placeholder="New film description">
            <input id="text" type="text" name="image" autofocus placeholder="New film image">
            <input id="text" type="text" name="trailer" autofocus placeholder="New film trailer">
            <input id="text" type="number" step="any" name="cost" autofocus placeholder="New film cost">
            <input id="text" type="number" name="genre" autofocus placeholder="New film genre">
            <input id="text" type="number" name="pegi" autofocus placeholder="New film pegi">
            <input id="text" type="number" name="outdated" autofocus placeholder="Outdated 0=no 1 = yes">
			<input id="button" type="submit" name="modifyfilm" value="Modify Film"><br><br>
		</form>
	</div>
    <table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Rating</th>
        <th>Genre</th>
        <th>Cost</th>
        <th>Outdated</th>
    </tr>
    <?php
        $sql = "SELECT * FROM films";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["films_id"]. "</td><td>" . $row["title"] . "</td> <td>" . $row["rating"] . "</td><td>"
            . $row["genre"]. "</td><td>". $row["cost"]. "</td> <td>". $row["outdated"]. "</td> </tr>";
            }
            echo "</table>";
        } else { echo "0 results"; 
        }
    ?>
    </table>
</body>
</html>