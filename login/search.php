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
        <form id="form" method="Post">
            <input name="search" type = "text" placeholder="What film are you looking for?" id="search" class="search">
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
        
            if (isset($_POST['submit-search'])) {
                //making sure teh data is safe
                $search = mysqli_real_escape_string($con, $_POST['search']);
                $query = "select * from films where title like '%$search%'";
                $result = mysqli_query($con, $query);
                $queryResult = mysqli_num_rows($result);
                if ($queryResult > 0) {
                    while($data = mysqli_fetch_assoc($result)){
                        if($data['outdated']== 0) {
                        ?>
                        <div class="movie">
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
                        }else {
                            echo "There were no results matching your result";
                        }
                    }
                
                }else {
                    echo "There were no results matching your result";
                }

            }
            
            ?>
    </main>
</body>
</html>
