<?php 
session_start();
    $variable1 = "0";
    $varFilmiD = "0";
	include("connection.php");
	include("functions.php");
    //redirection to log in
	$user_data = check_login($con);

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="trailerCSS.css">
    <title>My website</title>
</head>
<body>

    <a id="logo" href="index.php"><img id="logo_home"src="Home.png"></a>
    <main id="main">
        <?php 
            
            if (isset($_POST['submit-trailer'])) {
                //making sure teh data is safe
                $trailer = mysqli_real_escape_string($con, $_POST['trailer']);
                $query = "select * from films where title like '%$trailer%'";
                $result = mysqli_query($con, $query);
                $queryResult = mysqli_num_rows($result);
                if ($queryResult > 0) {          
                    $data = mysqli_fetch_assoc($result);
                    $varFilmiD = $data['films_id']
                    ?>
                    <iframe id="video_tr" src="<?php echo $data['trailer'];?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <?php 
                }else {
                    echo "There were no results matching your result";
                }

            }
            if (isset($_POST['pay-film'])) {
                header("Location: index.php");
            }
            
            ?>
    </main>
    
            <form action="" method="Post">
                    <!--<input id="input" type = "hidden" name="trailer">-->
                    <button id ="pay_b" type="submit" name="pay-film"><a id="link" href="paymentPage.php?variable1=<?php echo $variable1 ?>&varFilmiD=<?php echo $varFilmiD ?>">Price/week: <?php echo $data['cost'];?> €</a></button>
            </form>
</body>
</html>
