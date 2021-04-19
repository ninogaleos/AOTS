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
    <a href="FAQ's.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">FAQ's</a>
    <a href="ContactUs.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Contact Us</a>
    <a href="AboutUs.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-white">About Us</a>
   
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
<h1>About Us</h1>
</header>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-twothird">
      <h1>About Us</h1>
      <h5 class="w3-padding-32">Angasil Port is a Ferry terminal in Mactan Lapu-lapu City. This is one of the terminal
        port located in Angasil Rd. Lapu-Lapu City. Transported Via Olango to Mactan and Vice Versa.
      </h5>

      <p class="w3-text-grey">Commuter will book early using Angasil Online Ticketing system. Commuter see our schedule and
        availability in our Dashboard. In terms of Booking, the commuters all need to register first and then proceed  to our registration form.
      </p>
      <p class="w3-text-grey">
        In terms of Payment Angasil Online ticketing System, Used Gcash only no Gcash no Booking.
      </p>
      <br><br>
      <h4>M.L Quezon Highway,</h4>
      <h4>Angasil Road, Lapu-Lapu City</h4>
      <h5>Phone: 09172223331</h5>
      <h5>Email Add: anagasilport@gmail.com</h5>
    </div>

    <div class="w3-third w3-center">
        <img src="images/AOTSLOGO.PNG" alt="" width="300px" height="300px">
    </div>
  </div>
</div>


<!-- Footer -->

<div class="w3-row-padding" style="margin:0 -16px">
  <div class="w3-col s4">
    <img src="images/cover1.jpg" style="width:100%;cursor:pointer"
    onclick="openModal();currentDiv(1)" class="w3-hover-shadow">
  </div>
  <div class="w3-col s4">
    <img src="images/cover2.jpg" style="width:100%;cursor:pointer"
    onclick="openModal();currentDiv(2)" class="w3-hover-shadow">
  </div>
  <div class="w3-col s4">
    <img src="images/cover3.jpg" style="width:100%;cursor:pointer"
    onclick="openModal();currentDiv(3)" class="w3-hover-shadow">
  </div>
</div>

<div id="myModal" class="w3-modal w3-black">
 <span class="w3-text-white w3-xxlarge w3-hover-text-grey w3-container w3-display-topright" onclick="closeModal()" style="cursor:pointer">×</span>
 <div class="w3-modal-content">

  <div class="w3-content" style="max-width:1200px">
   <img class="mySlides" src="images/cover1.jpg" style="width:100%">
   <img class="mySlides" src="images/cover2.jpg" style="width:100%">
   <img class="mySlides" src="images/cover3.jpg" style="width:100%">
   <div class="w3-row w3-black w3-center">
    <div class="w3-display-container">
     <p id="caption"></p>
     <span class="w3-display-left w3-btn" onclick="plusDivs(-1)">❮</span>
     <span class="w3-display-right w3-btn" onclick="plusDivs(1)">❯</span>
    </div>
    <div class="w3-col s4">
     <img class="demo w3-opacity w3-hover-opacity-off" src="images/cover1.jpg" style="width:100%" onclick="currentDiv(1)" alt="Nature and sunrise">
    </div>
    <div class="w3-col s4">
     <img class="demo w3-opacity w3-hover-opacity-off" src="images/cover2.jpg" style="width:100%" onclick="currentDiv(2)" alt="French Alps">
    </div>
    <div class="w3-col s4">
     <img class="demo w3-opacity w3-hover-opacity-off" src="images/cover3.jpg" style="width:100%" onclick="currentDiv(3)" alt="Mountains and fjords">
    </div>
   </div> <!-- End row -->
  </div> <!-- End w3-content -->
  
 </div> <!-- End modal content -->
</div> <!-- End modal -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity">  
  <div class="w3-xlarge w3-padding-32">
  <div class="w3-container">
</div>
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
  setTimeout(carousel, 2000); // Change image every 2 seconds
}
function openModal() {
  document.getElementById('myModal').style.display = "block";
}

function closeModal() {
  document.getElementById('myModal').style.display = "none";
}

var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
  }
  x[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " w3-opacity-off";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>

</body>
</html>