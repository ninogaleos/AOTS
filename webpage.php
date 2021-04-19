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
</style>
<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-teal w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="webpage.php" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
    <a href="FAQ's.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">FAQ's</a>
    <a href="ContactUs.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Contact Us</a>
    <a href="AboutUs.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">About Us</a>
  </div>
  <div class=" w3-right-align ">
  <button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-green w3-large">Login</button>
</div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="FAQ's.php" class="w3-bar-item w3-button w3-padding-large">FAQ's</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Contact Us</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">About Us</a>
   
  </div>
</div>

<!-- Header -->
<header class="w3-container w3-teal" style="padding: 0;">
  <img class="mySlides w3-animate-fading" src="images/cover1.jpg" style="width:100%">
  <img class="mySlides w3-animate-fading" src="images/cover2.jpg" style="width:100%">
  <img class="mySlides w3-animate-fading" src="images/cover3.jpg" style="width:100%">
 
</header>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content ">
    <div class="w3-twothird">
      <h1>Angasil Port- Boat or Ferry Terminal</h1>
        <div class="w3-container w3-card-4 w3-teal w3-padding w3-border" style="width:80%;">
        <form method="Post" clas="w3-container">
        <label class="w3-text-white"><b> Choose Date </b></label>
        <input type="date" class="w3-input w3-border w3-light-grey " name="srch_inpt">
        <br>
          <button class="w3-btn w3-green" name="search">Search</button>
        </form> 
      </div>
      
    </div>

    <div class="w3-third w3-center">
       <?php
            if(isset($_POST['search'])){
                $srch_inpt = $_POST['srch_inpt'];
              
                
                $sql = "SELECT * FROM boat_tb WHERE BoatDate=? and status=1 ORDER BY BoatDate DESC ";
                $stmt = $conn->prepare($sql); 
                $stmt->bind_param("s", $srch_inpt);
                $stmt->execute();
                $result = $stmt->get_result();
               
                while ($row = $result->fetch_assoc()) {?>
                 <li class="w3-bar w3-teal" style="width: 500px;">
                    <span onclick="this.parentElement.style.display='none'"
                    class="w3-bar-item w3-button w3-xlarge w3-right">&times;</span>
                    <img src="images/img_avatar2.png" class="w3-bar-item w3-circle" style="width:150px">
                    <br><br>
                    <span class="w3-xlarge w3-padding "><?php echo $row['BoatName'];?></span><br>
                    <br>
                      <div class="w3-container w3-left w3-left-align">
                       <span class="w3-large ">Destination:&nbsp; <?php echo $row['BoatDestination'];?></span><br>
                        <span class="w3-large">Time:&nbsp;<?php echo $row['BoatTime'];?></span><br>
                        <span class="w3-large">Date:&nbsp;<?php echo $row['BoatDate'];?></span><br>
                        <span class="w3-large">Capacity:&nbsp;<?php echo $row['boat_capacity'];?></span><br>
                        <br>
                        <span><Button class="w3-btn w3-blue w3-large">Book</Button></span>
                        <br><br>
                      </div>
                </li>
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
        <img src="images/socialmedia.png" alt="" width="300px" height="300px">
    </div>

    <div class="w3-twothird">
      <h1>Recent Post</h1>
      <h5 class="w3-padding-32">The quick brown fox jump over the lazy dogThe quick brown fox jump over the lazy dogThe quick brown fox jump over the lazy dog</h5>

      <p class="w3-text-grey">The quick brown fox jump over the lazy dog.The quick brown fox jump over the lazy dog.The quick brown fox jump over the lazy dog.
      The quick brown fox jump over the lazy dog.The quick brown fox jump over the lazy dog.
      </p>
    </div>
  </div>
</div>

<div class="w3-container w3-black w3-center w3-opacity w3-padding-64">
    <h1 class="w3-margin w3-xlarge">They compel people to start their days on the right foot. But while letting a smile be your umbrella might fortify your positive attitude, it’s not going to inspire your business ventures.</h1>
</div>
<!-- <-----------Login Form -----------> -->
<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
  
      <div class="w3-center"><br>
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">×</span>
        <img src="images/img_avatar2.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
      </div>

      <form class="w3-container" action="/action_page.php">
        <div class="w3-section">
          <label><b>Username</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="usrname" required>
          <label><b>Password</b></label>
          <input class="w3-input w3-border" type="text" placeholder="Enter Password" name="psw" required>
          <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Login</button>
          <input class="w3-check w3-margin-top" type="checkbox" checked="checked"> Remember me
        </div>
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
        <span class="w3-right w3-padding w3-hide-small">Forgot <a href="#">password?</a></span>
      </div>

    </div>
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