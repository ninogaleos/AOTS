<?php
    include "includes/connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<title>Angasil Port Terminal </title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="css/fontawesome.css">
<link rel="stylesheet" href="css/fontawesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:200px}
.mySlides {display:none;}
#displayDiv {
  background-color: #eee;
  width: 300px;
  height: 600px;
  border: 1px dotted black;
  overflow: auto;
}
</style>
<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-teal w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="index.php" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
    <a href="FAQ's.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">FAQ's</a>
    <a href="ContactUs.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Contact Us</a>
    <a href="AboutUs.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">About Us</a>
  </div>
  <div class=" w3-right-align ">
  <button class="w3-button w3-green w3-large"><a href="login.php">Login</a></button>
</div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="FAQ's.php" class="w3-bar-item w3-button w3-padding-large">FAQ's</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Contact Us</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">About Us</a>
   
  </div>
</div>

<!-- Header -->
<header class="w3-container w3-teal " style="padding: 0;">
  <img class="mySlides w3-animate-opacity" src="images/cover1.jpg" style="width:100%">
  <img class="mySlides w3-animate-opacity" src="images/cover2.jpg" style="width:100%">
  <img class="mySlides w3-animate-opacity" src="images/cover3.jpg" style="width:100%">
 
</header>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-twothird">
      <h1>Angasil Port- Boat or Ferry Terminal</h1>
      <div class="w3-container w3-padding w3-teal w3-card-4" style="width:80%;">
          <header class="w3-container">
             <h4> Search Available Boat </h4>
          </header>
        <form action="" method="POST">
              <label class="w3-text-white"><b>Choose Date </b></label>
              <input type="date" class="w3-input w3-border w3-light-grey" name="dates" required>
              <br>
              <button class="w3-btn w3-green" name="search" >Search</button>
        </form>
      </div>

    </div>
    <div class="w3-third w3-card-4 w3-center w3-border w3-padding" id="displayDiv">
          <?php
             
              if(isset($_POST['search'])){
                $dates = $_POST['dates'];
                  $stat='1';

                  $sql = "SELECT * FROM boat_tb WHERE status=? and BoatDate=? ORDER BY BoatDate DESC ";
                  $stmt = $conn->prepare($sql); 
                  $stmt->bind_param("is", $stat, $dates);
                  $stmt->execute();
                  $result = $stmt->get_result();
                 
                  while ($row = $result->fetch_assoc()) {?>
                        <div class="w3-container w3-card-4 " style="width: 100%; ">
                        <form action="userBooking2.php" method="POST">
                          <div class="w3-aln-left">
                          <span><img src="images/boat.png" style="width:50px;" alt=""></span><br>
                            <span>Boat Name :<?php echo $row['BoatName'];?></span><br>
                            <span>Destination:<?php echo $row['BoatDestination'];?></span><br>
                            <span>Time:<?php echo $row['BoatTime'];?></span><br>
                            <span>Date:<?php echo $row['BoatDate'];?></span><br>
                            <span>Available Slot:<?php echo $row['boat_capacity'];?></span><br>
                            <span>Capacity:<?php echo $row['original_capacity'];?></span><br>
                            <br>
                              <input type="text" name="boat_id" value="<?php echo $row['BoatId'];?>" hidden>
                            <button class="w3-btn w3-green">Book Now</button>
                            <br> <br>
                        </div>
                        </div>
                    <br>
                  <?php
                  }
              } 
          ?>
    </div>  
  </div>
</div>

<!-- Second Grid -->
<div class="w3-row-padding w3-light-grey w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-third w3-center">
        <img src="images/AOTSLOGO.png" alt="" width="300px" height="300px">
    </div>

    <div class="w3-twothird">
      <h1>About Us</h1>
      <h5 class="w3-padding-32">Angasil Port is a Ferry terminal in Mactan Lapu-lapu City. This is one of the terminal
        port located in Angasil Rd. Lapu-Lapu City. Transported Via Olango to Mactan and Vice Versa. <a href="AboutUs.php" class=" w3-btn w3-green">Read More</a>
      </h5>
    </div>
  </div>
</div>

<div class="w3-container w3-black w3-center w3-opacity w3-padding-64">
    <h1 class="w3-margin w3-xlarge">They compel people to start their days on the right foot. But while letting a smile be your umbrella might fortify your positive attitude, it’s not going to inspire your business ventures.</h1>
</div>
<!-- <-----------Login Form -----------> 

  </div>
</div>
<!-------end of login------------->
<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity">  
  <div class="w3-xlarge w3-padding-32">
   
 </div>

</footer>

<script>
// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 4000); // Change image every 2 seconds
}
</script>

</body>
</html>