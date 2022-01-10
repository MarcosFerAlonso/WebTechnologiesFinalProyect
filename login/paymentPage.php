<?php
session_start();

include("connection.php");
include("functions.php");

$variable1=($_GET['variable1']);
$varFilmiD=($_GET['varFilmiD']);
$user_data = check_login($con);
$client_id  = $user_data['users_id'];  
  if ($variable1==0) {
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
      //something was posted mysqli_real_escape_string($con, $_POST['id_client']); 
      if(isset($_POST['submit-payment'])) {
        $type = mysqli_real_escape_string($con,$_POST['cardType']);
        $cc_number = mysqli_real_escape_string($con,$_POST['cc_number']);
        $cc_ccv =  mysqli_real_escape_string($con,$_POST['cc_ccv']);
        $cc_date = mysqli_real_escape_string($con,$_POST['cc_date']);
        $cc_owner = mysqli_real_escape_string($con,$_POST['cc_name']);
        $date = new DateTime();
        $final_date = date_format($date, 'd-m-Y');
        
        if($user_data['premium']==1){
          if(!empty($type) && ($final_date < $cc_date) )
          {
            //save to database
            $query = "insert into payments (payment_id,client_id,type,cc_number,cc_date,cc_ccv, cc_name, film_id)
            values ('','$client_id','$type','$cc_number','$cc_date','$cc_ccv','$cc_owner','$varFilmiD')";

            mysqli_query($con, $query);
            // Declare a date
            $date = new DateTime();
            // Use date_add() function to add date object
            date_add($date, date_interval_create_from_date_string("7 days"));
            //We get the payment id
            $query_payment = "select * from payments where client_id like '%$client_id%' and film_id like '%$varFilmiD%' order by payment_id DESC";
            $result = mysqli_query($con, $query_payment);                     
            $data = mysqli_fetch_assoc($result);
            $payments_id = $data['payment_id'];
            $final_date = date_format($date, 'Y-m-d');
            $query = "insert into rented_films (rent_id,payment_id,final_date,times_watched)
            values ('','$payments_id','$final_date','')";
            mysqli_query($con, $query);
            echo "sUCCESFUL!";
            header("Location: index.php");
            die;
            
          }else
          {
            echo "Please enter some valid information!";
          }
        } else {
          //if it is not premium check the number of films
          $query = "select DISTINCT r.* from payments p inner join rented_films r on p.payment_id = r.payment_id inner join films f on f.films_id = p.film_id where p.client_id='$client_id' and (r.final_date >= '$final_date')";
          $result = mysqli_query($con, $query);
          if(mysqli_num_rows($result) < 6) {
            if(!empty($type) && ($final_date < $cc_date) )
            {
            //save to database
            $query = "insert into payments (payment_id,client_id,type,cc_number,cc_date,cc_ccv, cc_name, film_id)
            values ('','$client_id','$type','$cc_number','$cc_date','$cc_ccv','$cc_owner','$varFilmiD')";

            mysqli_query($con, $query);
            // Declare a date
            $date = new DateTime();
            // Use date_add() function to add date object
            date_add($date, date_interval_create_from_date_string("7 days"));
            //We get the payment id
            $query_payment = "select * from payments where client_id like '%$client_id%' and film_id like '%$varFilmiD%' order by payment_id DESC";
            $result = mysqli_query($con, $query_payment);                     
            $data = mysqli_fetch_assoc($result);
            $payments_id = $data['payment_id'];
            $final_date = date_format($date, 'Y-m-d');
            $query = "insert into rented_films (rent_id,payment_id,final_date,times_watched)
            values ('','$payments_id','$final_date','')";
            mysqli_query($con, $query);
            echo "sUCCESFUL!";
            header("Location: index.php");
            die;
            
            }else
            {
              echo "Please enter some valid information!";
            }
          }else {
            echo "You cannot rent more films for now";
          }
        }
      } else {
        header("Location: index.php");
      }
    }
  } else{
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
      if(isset($_POST['submit-payment'])) {
        //something was posted
        $type = mysqli_real_escape_string($con,$_POST['cardType']);
        $cc_number = mysqli_real_escape_string($con,$_POST['cc_number']);
        $cc_ccv =  mysqli_real_escape_string($con,$_POST['cc_ccv']);
        $cc_date = mysqli_real_escape_string($con,$_POST['cc_date']);
        $cc_owner = mysqli_real_escape_string($con,$_POST['cc_name']);
        $date = new DateTime();
        $final_date = date_format($date, 'Y-m-d');
        $client_premium =  $user_data['premium'];
        if($client_premium == 0) {
          if(!empty($type) && ($final_date < $cc_date) )
          {
            //save to database
            $query = "insert into payments (payment_id,client_id,type,cc_number,cc_date,cc_ccv, cc_name,film_id)
            values ('','$client_id','$type','$cc_number','$cc_date','$cc_ccv','$cc_owner','$varFilmiD')";

            mysqli_query($con, $query);
            $sql = "UPDATE users SET premium=1 WHERE users_id='$client_id'";

            if ($con->query($sql) === TRUE) {
              echo "Record updated successfully";
            } else {
              echo "Error updating record: " . $con->error;
            }

            //Now we save it into the rented films table
            header("Location: index.php");
            die;
            
          }else
          {
            echo "Please enter some valid information!";
          }
        } else {
            echo "you already are premium";
        }
      }
      else {
        header("Location: index.php");
      }
    }

  }
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="paymentCSS.css">
    <title>My website</title>
</head>
<body>
  <form method="post">
    <div id="wrapper">
      <div class="row">
        <div class="col-xs-5">
          <div id="cards">
            <img src="http://icons.iconarchive.com/icons/designbolts/credit-card-payment/256/Visa-icon.png">
            <img src="http://icons.iconarchive.com/icons/designbolts/credit-card-payment/256/Master-Card-icon.png">
          </div><!--#cards end-->
          <div class="form-check">
      <label class="form-check-label" for='card'>
        <input id="card" class="form-check-input" type="radio" name="cardType" value="card" checked>
        Pay with VISA or Master Card
      </label>
    </div>
        </div><!--col-xs-5 end-->
        <div class="col-xs-5">
          <div id="cards">
            <img src="http://icons.iconarchive.com/icons/designbolts/credit-card-payment/256/Paypal-icon.png">
          </div><!--#cards end-->
          <div class="form-check">
      <label class="form-check-label" for='paypal'>
        <input id="paypal" class="form-check-input" type="radio" name="cardType" value="paypal" >
        Pay with PayPal
      </label>
    </div>
        </div><!--col-xs-5 end-->
      </div><!--row end-->
      <div class="row">
        <div class="col-xs-5">
          <i class="fa fa fa-user"></i>
          <label for="cardholder">Cardholder's Name</label>
          <input type="text" id="cardholder" name="cc_name" required>
        </div><!--col-xs-5-->
        <div class="col-xs-5">
          <i class="fa fa-credit-card-alt"></i>
          <label for="cardnumber">Card Number</label>
          <input type="text" id="cardnumber"  pattern="([0-9]{16})" name="cc_number" placeholder="XXXXXXXXXXXXXXXX" required>
        </div><!--col-xs-5-->
      </div><!--row end-->
      <div class="row row-three">
        <div class="col-xs-2">
          <i class="fa fa-calendar"></i>
          <label for="date">Validation Date</label>
          <input type="date" min="01-12-2021" id="date" name="cc_date" required>
        </div><!--col-xs-3-->
        <div class="col-xs-2">
          <i class="fa fa-lock"></i>
          <label for="date">CVV / CVC </label>
          <input type="number" maxlength="3" pattern="([0-9]|[0-9]|[0-9])" name="cc_ccv" required>
        </div><!--col-xs-3-->
        <div class="col-xs-2">
        </div><!--col-xs-6 end-->
      </div><!--row end-->
      <footer>
        <input class="btn" type="submit" name="submit-payment" value ="Pay">  
        <button class="btn" value ="cancel" formnovalidate>Cancel</buton>
      </footer>
      
    </div><!--wrapper end-->
  </form>
</body>
</html>
