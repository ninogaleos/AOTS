<?php
include "includes/connection.php";
 session_start();
 if(!isset($_SESSION["loggedin"])){
    header('Location: index.php');
    exit;
  }
?>
<!doctype HTML>
<html lang='en'>
    <title>Angasil Online Ticket System</title>
    <head>
      <style>
          @media print
    {
        #non-printable { display: none; }
        #printable { display: block; }
    }
      </style>
    </head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/w3.css">


    
  <body>
  <div class="w3-sidebar w3-light-grey w3-bar-block" style="width:20%;">
    <div class="w3-container w3-teal">
    <br><br>
    <img src="icons/avatar.png" alt="Avatar" class="w3-left w3-circle w3-margin-right">
    <p><?php echo $_SESSION['completename'];?></p>
    <a href="includes/logout.php">Logout</a>
      <hr>
    </div>
    <div class="w3-center w3-large w3-green">
            <button class="w3-btn"><a href="index.php">Back to Website</a></button>
        </div>
    <div class="w3-container">
     <h3 class="w3-bar-item">Menu</h3>
    <a href="userHome.php" class="w3-bar-item w3-button">Book Ticket</a>
    <a href="userBooking.php" class="w3-bar-item w3-button">My Booking</a>
    <a href="useraccount.php" class="w3-bar-item w3-button">My Account</a>
    </div>
  
</div>
    <div style="margin-left:20%" class="w3-container w3-teal">
    <h1>My Booking Ticket</h1>
</div>
<div class="w3-container" style="margin-left:20%;">
<br><br>

  
<div class="w3-container">
    <?php
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM user_tb WHERE user_id=?";
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
       
        while ($row = $result->fetch_assoc()) {
            ?>
                <form action="includes/updateaccounts.php" method="POST" class="w3-container w3-border w3-padding" style="width:50%;">

                    <input type="hidden" name="user_id" value="<?php echo $row['user_id']?>">
                    <label class="w3-text-teal"><b>Complete Name</b></label>
                    <input class="w3-input w3-border" name="completename" type="text" value="<?php echo $row['user_complete_name'];?>">
                    
                    <label class="w3-text-teal"><b>Address</b></label>
                    <input class="w3-input w3-border" name="address" type="text" value="<?php echo$row['user_address'];?>">
                   
                    <label class="w3-text-teal"><b>Email Address</b></label>
                    <input class="w3-input w3-border" name="emailadd" type="text" value="<?php echo$row['user_email_add'];?>">
                    
                    <label class="w3-text-teal"><b>Username</b></label>
                    <input class="w3-input w3-border" name="user_username" type="text" value="<?php echo$row['user_username'];?>">

                    <label class="w3-text-teal"><b>Password</b></label>
                    <input class="w3-input w3-border" name="password" type="password" value="<?php echo$row['user_password'];?>">
                    <br>
                    <button class="w3-btn w3-teal" name="updateacct">UPDATE</button>
                    <br><br>
                </form>
                <br>
            <?php
        }
        
    ?>
</div>
</div>
<footer style="margin-left:20%" class="w3-container w3-teal">
  <h5>Footer</h5>
  <p>Footer information goes here</p>
</footer>
    </body>

</html> 