<?php 
session_start();

	include("connection.php");
	include("functions.php");

    //redirection to log in
    $user_data = check_login($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="indexGenreCSS.css">
    <title></title>
    
</head>
<body>
        <div class="genre_header">
            <a id="logo" href="index.php"><img id="logo_home"src="Home.png"></a>
            <h2 id = "title">Choose the filter or filters you want:</h2>  
        </div>
        <!-- Gnere List  -->
        <div class="genreList">
            <form action="" method="GET">
                <h5>Filters: 
                    <button type="submit" id ="search" >Search</button>
                </h5>
                <?php
                    $genre_query = "SELECT * FROM genres";
                    $genre_query_run  = mysqli_query($con, $genre_query);

                    if(mysqli_num_rows($genre_query_run) > 0)
                    {
                        ?>
                        
                        <div class="cx">
                        <?php
                        foreach($genre_query_run as $genrelist)
                        {
                            $checked = [];
                            if(isset($_GET['genres']))
                            {
                                $checked = $_GET['genres'];
                            }
                            ?>
                                
                                    <input type="checkbox" name="genres[]" value="<?= $genrelist['id']; ?>" 
                                    <?php 
                                        if(in_array($genrelist['id'], $checked)){
                                                echo "checked"; 
                                        }
                                    ?>
                                    />
                                    <?= $genrelist['film_genre']; ?>
                                
                            <?php
                        }
                        ?>
                        </div>
                        <?php
                    }
                    else
                    {
                        echo "No Brands Found";
                    }
                ?>
            </form>
        </div>
        
        <main id="main">
            <?php
                if(isset($_GET['genres']))
                {
                    $branchecked = [];
                    $branchecked = $_GET['genres'];

                    foreach($branchecked as $rowbrand)
                    {
                        // echo $rowbrand;
                        $products = "SELECT * FROM films WHERE genre IN ($rowbrand)";
                        $products_run = mysqli_query($con, $products);
                        if(mysqli_num_rows($products_run) > 0)
                        {
                            foreach($products_run as $proditems) :
                                if($proditems['outdated']== 0) {
                                ?>
                                    <div class="movie">
                                        <form id="form" action="trailerDisplay.php" method="Post">
                                            <input id="input" value="<?php echo $proditems['title'];?>" type = "hidden" name="trailer">
                                            <button type="submit" name="submit-trailer"> <?php echo "<img src='{$proditems['image']}' width='40%'>";?>
                                            </button>
                                        </form>
                                        <div class="movie-info">
                                            <h3> 
                                                <?php 
                                                echo  $proditems['title'];
                                                ?>
                                            </h3>
                                            <span class="green"> 
                                                <?php 
                                                    echo  $proditems['rating'];
                                                ?>
                                            </span>
                                            <div class="overview">
                                                <?php
                                                    echo  $proditems['description'];
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                            endforeach;
                        }
                    }
                }
                else
                {
                    $products = "SELECT * FROM films";
                    $products_run = mysqli_query($con, $products);
                    if(mysqli_num_rows($products_run) > 0)
                    {
                        foreach($products_run as $proditems) :
                            if($proditems['outdated']== 0) {
                            ?>
                            <div class="movie">
                                <form id="form" action="trailerDisplay.php" method="Post">
                                    <input id="input" value="<?php echo $proditems['title'];?>" type = "hidden" name="trailer">
                                    <button type="submit" name="submit-trailer"> <?php echo "<img src='{$proditems['image']}' width='40%'>";?>
                                    </button>
                                </form>
                                    <div class="movie-info">
                                        <h3> 
                                            <?php 
                                            echo  $proditems['title'];
                                            ?>
                                        </h3>
                                        <span class="green"> 
                                            <?php 
                                                echo  $proditems['rating'];
                                            ?>
                                        </span>
                                        <div class="overview">
                                            <?php
                                                echo  $proditems['description'];
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                        endforeach;
                    }
                    else
                    {
                        echo "No Items Found";
                    }
                }
            ?>
        </main>
</body>
</html>
