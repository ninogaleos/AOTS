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
        <head></head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/w3.css">
        <!-- <link rel="stylesheet" href="css/js/jquery.min.js">
        <link rel="stylesheet" href="css/js/bootstrap.min.css">
        <script src="css/js/jquery.min1.js"></script>
        <script src="css/js/bootstrap.min.js"></script> -->
      
        
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
        
    <h3 class="w3-bar-item">Menu</h3>
    <a href="userHome.php" class="w3-bar-item w3-button">Book Ticket</a>
    <a href="userBooking.php" class="w3-bar-item w3-button">My Booking</a>
    <a href="useraccount.php" class="w3-bar-item w3-button">My Account</a>
    </div>
        <div style="margin-left:20%" class="w3-container w3-teal">
        <h1>Booking Ticket</h1>
    </div>
    <div class="w3-container" style="margin-left:20%">
       

    <div class="w3-container" > 
    <form action="#" class="w3-container" method="POST" enctype="multipart/form-data">
    <div class="w3-container" >
                <br><br>
            </div>
            <div class="w3-row">
            <div class="w3-col s6  ">
                        <p>Choose Date first to see available Boat on that date</p>
                    <label class="w3-text-teal w3-left"><b>Booking Date</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="date"  name="dates">
                <br>
                <button name="searchs" class="w3-button w3-green">Search</button>
                </form>
                <form action="includes/booking.php" method="POST"  enctype="multipart/form-data">
                <br><br>
                <?php
                if(isset($_POST['searchs']))
                {
                    $dates = $_POST['dates'];

                  echo "<input type='hidden' value='$dates'name='bookDate'> ";
                ?>
                  
                <br>
                <label class="w3-text-teal w3-left"><b>Choose Boat Available</b></label>
                <br>
                    <select class="w3-select w3-border w3-light-grey"  name="boatname" required>
                    <option value="1">Boat Name</option>

                <?php
                    $query=mysqli_query($conn,"select * from `boat_tb` where BoatDate ='$dates' and status=1 ");
                    while($row=mysqli_fetch_array($query)){
                        ?>  
                    <option value="<?php echo $row['BoatId'];?>">
                        <p> <?php echo $row['BoatName'];?></p>
                        <p><?php echo $row['BoatDestination'];?></p>
                        <p><?php echo $row['BoatTime'];?></p>
                        <p><?php echo $row['boat_capacity'];?></p>
                    </option>
                    
                <?php
                    echo $row['BoatId'];
                    echo $row['boat_capacity'];
                }
                }        
                ?>
                </select>
                <br>
                <label class="w3-text-teal w3-left"><b>Type</b></label>
                <br>
                <select class="w3-select w3-border w3-light-grey" onchange='selectOnChange(this)' name="type" required >
                        <option value="0">Choose Type</option>
                        <option value="30">Regular</option>
                        <option value="25">Student</option>
                        <option value="20">PWD / Senior Citizen</option>
                </select>
                <br>
                <label class="w3-text-teal w3-left"><b>Price</b></label>
                <br>
                <input type="text" class="w3-input w3-border w3-light-grey" id="price" name="prices" readonly>
              
                <label class="w3-text-teal w3-left"><b>Passenger Complete Name</b></label> 
                <input type="text" class="w3-input w3-border w3-light-grey" name="tckt_name" placeholder="Firstname | Lastname" required>
                <br>
                <label class="w3-text-teal"><b>Attachment</b></label>
                <br>
                <input type="file" class="w3-input w3-border w3-light-grey"  name="attachment-pic" accept="image/*" required>
            
            </div>
            <div class="w3-col s6 ">
                <label class="w3-text-teal"><b>Payment</b></label>
                    <p> Go to your Gcash app 
                    Send Money and Scan QRCODE Below or use express Setting.
                    How to pay <a href="https://help.gcash.com/hc/en-us/articles/360017722773-How-to-Pay-QR-using-the-GCash-App">Click Here</a></p>
                    <img src="icons/qrcode.jpg" alt=""> 

                    <span>
                    <h5> &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;09271519130</h5>
                    </span>

                    <p>Pay the Total Amount of PHP <input type="text" id="total" disabled></p>
                <br>
                <label class="w3-text-teal"><b>Reference Number</b></label>
                <br>
                <input type="text" class="w3-input w3-border w3-light-grey"  name="reference" required>
            </div>
         </div>
           

    </div>
    
                <div class="w3-center">
                <br><br>
                <button class="w3-btn w3-green" name="Book">Book</button>
                <button class=" w3-btn w3-red">Cancel</button>
                <br>
                <br>
                </div>
          </form>      
    </div>
    
    <script  type="text/javascript">
    function selectOnChange(obj) {
          var val = obj.options[obj.selectedIndex].value;
         var text = obj.options[obj.selectedIndex].text;
         document.getElementById("price").value = val;
         document.getElementById("total").value = val+'.00';
        
      }
    </script>
    <footer style="margin-left:20%" class="w3-container w3-teal">
    <h5>Footer</h5>
    <p>Footer information goes here</p>
    </footer>
        </body>

    </html>