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
                    $varFilmiD = $data['films_id'];
                    if ($user_data['premium'] == 1) {
                        ?>
                        <iframe id="video_tr" src="<?php echo $data['trailer'];?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <?php 
                    } else {
                        $date = new DateTime();
                        $final_date = date_format($date, 'Y-m-d');
                        $user_id = $user_data['users_id'];
                        $query_times_watched = "select r.*, p.* from payments p inner join rented_films r on p.payment_id = r.payment_id where (p.client_id = '$user_id') and (p.film_id ='$varFilmiD') and (r.final_date >= '$final_date') order by r.rent_id DESC limit 1";
                        $result2 = mysqli_query($con, $query_times_watched); 
                        $times = mysqli_fetch_assoc($result2);
                        
                        if ($times['times_watched'] < 3) {  
                            $watched = $times['times_watched']  + 1;
                            $payment = $times['payment_id'];
                            $sql = "UPDATE rented_films r SET r.times_watched=('$watched') WHERE payment_id='$payment'";
                            $con->query($sql);
                            
                            ?>
                            <iframe id="video_tr" src="<?php echo $data['trailer'];?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            <button id ="pay_b" >Times watched: <?php  echo $watched; ?>/3 </button>
                            <?php
                        } else {
                            header("Location: rentedFilmsIndex.php");
                        }
                    }
                }else {
                    echo "There were no results matching your result";
                }

            }
            if (isset($_POST['pay-film'])) {
                header("Location: index.php");
            }
            
            ?>
    </main>
</body>
</html>
