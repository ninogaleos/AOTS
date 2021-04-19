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

</style>
<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-teal w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="index.php" class="w3-bar-item w3-button w3-padding-large w3-hover-white">Home</a>
    <a href="FAQ's.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-white ">FAQ's</a>
    <a href="ContactUs.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Contact Us</a>
    <a href="AboutUs.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">About Us</a>
   
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="FAQ's.php" class="w3-bar-item w3-button w3-padding-large">FAQ's</a>
    <a href="ContactUs.php" class="w3-bar-item w3-button w3-padding-large">Contact Us</a>
    <a href="AboutUs.php" class="w3-bar-item w3-button w3-padding-large">About Us</a>
   >
  </div>
</div>

<!-- Header -->
<header class="w3-container w3-teal w3-center" style="padding:128px 16px">
<h1>Frequently Ask Question ?</h1>
</header>

<!-- Second Grid -->
<div class="w3-row-padding w3-light-grey w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-third w3-center">
        <img src="images/question.jpg" alt="" width="300px" height="300px">
    </div>

    <div class="w3-twothird">
      <h1>Why Angasil Online Ticketing System?</h1>
      <h5 class="w3-padding-32">This offers future traveler the night to book a ticket wherever they want.</h5>
      <h5 class="w3-padding-32">Its's works all the time . They work 24/7</h5>
      <h5 class="w3-padding-32">Can instantly see live availability .</h5>
      <h5 class="w3-padding-32">Get smarter Insights into your Bussiness</h5>
      <h5 class="w3-padding-32">Hassle-Free</h5>

    
    </div>
  </div>
</div>


<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity w3-teal">  
  <div class="w3-xlarge ">
   
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
function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 2000); // Change image every 2 seconds
}
</script>

</body>
</html>