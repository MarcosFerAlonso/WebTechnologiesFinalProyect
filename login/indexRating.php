<?php 
session_start();

	include("connection.php");
	include("functions.php");

    //redirection to log in
    $user_data = check_login($con);
    if (isset($_POST['all'])) {
        header("Location: index.php");
    }
    if (isset($_POST['best-rated'])) {
        header("Location: indexRating.php");
    }
    if (isset($_POST['genre'])) {
        header("Location: indexGenre.php");
    }

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
				<li><a href="logout.php">Log out</a></li>
				<li><a href="users.php">Premium</a></li>
			</ul>
		</nav>
	</header>
    <header>
        <form id="form" action="searchRating.php" method="Post">
            <input name="search" type = "text" placeholder="Remember only films with >7 rating will appear" id="search" class="search">
            <button id="search_logo_button" type="submit" name="submit-search"><img id="search_logo" src="search_logo.png"></button>
        </form>
    </header>
    <div  class="filters">
        <form action="" method="Post">
                <button id ="link" type="submit" name="all">All</button>
                <button id ="link" type="submit" name="best-rated">Best Rated</button>
                <button id ="link" type="submit" name="genre">Genre</button>
        </form>
    </div>
    <main id="main">
        <?php 
            $query = "select * from films where rating > 7 order by rating desc";
            $result = mysqli_query($con, $query);
            while($data = mysqli_fetch_assoc($result)){
                if($data['outdated']== 0) {
                ?>
                <div  class="movie">
                    <form id="form" action="trailerDisplay.php" method="Post">
                        <input id="input" value="<?php echo $data['title'];?>" type = "hidden" name="trailer">
                        <button type="submit" name="submit-trailer"> <?php 
                    echo "<img src='{$data['image']}' width='40%'>";
                    ?></button>
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
