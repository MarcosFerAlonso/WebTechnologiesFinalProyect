<?php 
session_start();
    $variable1 = "1";
    $varFilmiD = "1000000";
	include("connection.php");
	include("functions.php");

    //redirection to log in
	$user_data = check_login($con);

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="indexCSS.css">
    <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script
    src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="userCSS.css">
    <title>My website</title>
</head>
<body>

    <div class="row">
        <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5" style="background-color:transparent";>
            <h1 id="title_pag1">Not premium yet?</h1>
            <div class="normal_box">
                <img id="normal_user" src="user.png"> 
                <div id="inside_box_title">
                    <h2 id = "basic_title">Basic User</h2>
                </div>  

                <div id="inside_box">
                    <h3 id = "basic_bnf">6 films per week</h3>
                </div> 

                <div id="inside_box">
                    <h3 id = "basic_bnf">You can watch them 3 times max</h3>
                </div> 

                <div id="inside_box">
                    <h3 id = "basic_bnf">High definition quality</h3>
                </div> 
            </div>
            <a id="logo" href="index.php"><img id="logo_home"src="Home.png"></a>
        </div>
        <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2" style="background-color:transparent";>
            <h2 id="monthly_price">4,99$/month</h2>
            <img id="arrow" src="arrow.png">
            <img id="pay_methods" src="paymethods.png">
            <form method="POST" action="">  
          
                <button id ="pay_button" type="submit" name="pay-film"><a id="pay_b" href="paymentPage.php?variable1=<?php echo $variable1 ?>&varFilmiD=<?php echo $varFilmiD ?>">Pay Now!</a></button>  
            </form> 
        </div>
        <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5" style="background-color:transparent";>
            <h1 id="title_pag2">What are you waiting for?</h1>

            <div class="premium_box">
                <img id="premium_user" src="user.png">

                <div id="inside_box_title">
                    <h2 id = "premium_title">Premium User</h2>
                </div>  

                <div id="inside_box">
                    <h3 id = "premium_bnf">No renting limits</h3>
                </div> 

                <div id="inside_box">
                    <h3 id = "premium_bnf">Watch as many times as desired</h3>
                </div> 

                <div id="inside_box">
                    <h3 id = "premium_bnf">High definition, 2k and 4k quality</h3>
                </div> 

                <div id="inside_box">
                    <h3 id = "premium_bnf">Gifts every 5 rented films</h3>
                </div> 
            </div>  
            
        </div>
    </div>
</body>
</html>
