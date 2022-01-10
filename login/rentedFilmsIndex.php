<?php 
session_start();

	include("connection.php");
	include("functions.php");
    //redirection to log in
	$user_data = check_login($con);
    $user_id = $user_data['users_id'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="indexCSS.css">
    <title>My website</title>
</head>
<body>
    <header id="main-header">
		
		<a id="logo-header" href="index.php">
			<span class="site-name">Films4U</span>
			<span class="site-desc">Your favourite Films site</span>
		</a> 
		<nav>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="logout.php">Log out</a></li>
				<li><a href="users.php">Premium</a></li>
			</ul>
		</nav>
	</header>
    
    <main id="main">
        <?php 
            $date = new DateTime();
            $final_date = date_format($date, 'Y-m-d');
            $query = "select DISTINCT f.* from payments p inner join rented_films r on p.payment_id = r.payment_id inner join films f on f.films_id = p.film_id where p.client_id='$user_id' and (r.final_date >= '$final_date')";
            $result = mysqli_query($con, $query);
            while($data = mysqli_fetch_assoc($result)){
                if($data['outdated']== 0) {
                ?>
                <div class="movie">
                    <form id="form" action="filmDisplay.php" method="Post">
                        <input id="input" value="<?php echo $data['title'];?>" type = "hidden" name="trailer">
                        <button type="submit" name="submit-trailer"> <?php echo "<img src='{$data['image']}' width='40%'>";?>
                        </button>
                    </form>
                    <div class="movie-info">
                        <h3> 
                            <?php 
                            echo  $data['title'];
                            ?>
                        </h3>
                        <span class="green"> 
                            <?php 
                                echo  $data['rating'];
                            ?>
                        </span>
                        <div class="overview">
                            <?php
                                echo  $data['description'];
                            ?>
                        </div>
                    </div>
                </div>
                <?php 
                }
            }
        ?>
    </main>
</body>
</html>
