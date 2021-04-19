<?php
session_start();
if(isset($_SESSION["name"])){
    header('Location: userHome.php');
    exit;
  }
?>
<!doctype HTML>
<html lang='en'>
    <title>Angasil Online Ticket System</title>
    <head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="css/w3.css">
    <body>
    
        <div class="w3-container w3-display-middle w3-teal w3-padding w3-card-4 " style="width:30%">
            <div class="w3-center">
                   <img src="icons/avatar.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
            </div>
     
                <form action="includes/login.php" class="w3-container" method="post">
                <br>
                 
                <input type="text" name="username" class="w3-input w3-border w3-xlarge  w3-hover-blue" placeholder="username" >
                <br>
               
                <input type="password" class="w3-input w3-border w3-hover-blue w3-xlarge" name="password" placeholder="Password" >
                <br><br>
                <div class="w3-right">
                    <button name="login" class="w3-button w3-green" >Submit</button>
                    <button name="cancel" class="w3-button w3-red" ><a href="index.php">Cancel</a></button>
                </div>
                <br><br>
                <p class="w3-center w3-large">Not yet Registered Click here <a href="register.php" class="w3-large">REGISTER</a></p> 
                <br>
            </form>
            <br>
        </div>
        <section class="w3-container">
        
            
           
        </section>
    </body>
   
</html>
