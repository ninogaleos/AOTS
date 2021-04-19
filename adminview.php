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
    <h3 class="w3-bar-item">Menu</h3>
    <a href="adminHome.php" class="w3-bar-item w3-button">Approve Booking</a>
    <a href="adminboat.php" class="w3-bar-item w3-button">Add Boat</a>
    <a href="admineditboat.php" class="w3-bar-item w3-button">Edit Boat</a>
    <a href="adminpassengerlist.php" class="w3-bar-item w3-button">Passenger</a>
    <a href="adminadduser.php" class="w3-bar-item w3-button">Add User</a>
    </div>
        <div style="margin-left:20%" class="w3-container w3-teal">
        <h1>Add of Boat</h1>
    </div>
    <div class="w3-container" style="margin-left:20%">
        <br>
       
            <br><br>
<div class="w3-container" > 
  <button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-teal">Add Boat</button>

    <br><br>
    <div id="id02" class="w3-modal">
    <div class="w3-modal-content w3-animate-top" style="width:40%;">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('id02').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2>ADD BOAT</h2>
      </header>
 
      <footer class="w3-container w3-teal">
        <p></p>
      </footer>
    </div>
  </div>

            <div class="container">
            <div class="w3-container w3-padding w3-card-4 w3-middle" style="width:100%">      
            <header class="w3-container w3-teal ">
               <h4>Validate Booking</h4>
            </header>
            <form action="includes/updatestatus.php" method="POST">
            <?php
                include "includes/connection.php";
                if(isset($_POST['view_booking'])){
                    $booking_id = $_POST['booking_id'];
                   
                    $sql = "SELECT * FROM booking_tb WHERE Booking_id=? ";
                    $stmt = $conn->prepare($sql); 
                    $stmt->bind_param("i", $booking_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()) {
                
                        ?>
                         <div class="container">
                            <input type="text" value="<?php echo $row['booking_id'];?>" name="bookingid" hidden><br>
                            <span><a class="w3-large w3-text-teal">Book Reference:</a><input type="text"class="w3-large w3-border-0" value="<?php echo $row['Booking_reference'];?>"> </span>
                            <span><a class="w3-large w3-text-teal">Booking Name:</a><input type="text"class="w3-large w3-border-0" value="<?php echo $row['user_name'];?>"> </span> <br>
                            <span><a class="w3-large w3-text-teal">Booking Date:</a><input type="text"class="w3-large w3-border-0" value="<?php echo $row['Booking_date'];?>"> </span><br>
                            <hr>
                            <?php
                                $id=$row['Boat_ID'];
                                   $sqls = "SELECT * FROM boat_tb WHERE BoatId=?";
                                   $stmts = $conn->prepare($sqls); 
                                   $stmts->bind_param("i", $id);
                                   $stmts->execute();
                                   $results = $stmts->get_result();
                                   while ($rows = $results->fetch_assoc()) {?>
                                    
                                    <span><a class="w3-large w3-text-teal">Boat Name:</a><input type="text"class="w3-large w3-border-0" value="<?php echo $rows['BoatName'];?>"> </span>
                                    <span><a class="w3-large w3-text-teal">Destination:</a><input type="text"class="w3-large w3-border-0" value="<?php echo $rows['BoatDestination'];?>"> </span> <br>
                                    <span><a class="w3-large w3-text-teal">Time:</a><input type="text"class="w3-large w3-border-0" value="<?php echo $rows['BoatTime'];?>"> </span><br>
                                      <span><a class="w3-large w3-text-teal">Time:</a><input type="text"class="w3-large w3-border-0" value="<?php echo $rows['BoatTime'];?>"> </span><br>
                                <?php   }
                            ?>
                            </div>
                            <div class="container">
                                <table class="w3-table w3-hoverable w3-border">
                                    <tr class="w3-teal">
                                        <th>Booking Date</th>
                                        <th>Type</th>
                                        <th>Price</th>
                                        <th>Ticket Name</th>
                                        <th>Status</th>
                                    </tr>
                                    <tr>
                                        <td><?php echo $row['Booking_date'];?></td>
                                        <td><?php echo $row['Booking_type'];?></td>
                                        <td><?php echo $row['Booking_price'];?></td>
                                        <td><?php echo $row['Booking_tckt_name'];?></td>
                                        <td><?php
                                            if($row['book_status']==1){
                                                    echo "Pending";

                                            }else if($row['book_status']==2){
                                                echo "Approved";
                                            }else if($row['book_status']==3){
                                                echo "Dissapproved";
                                            }
                                        ?></td>
                                    </tr>
                                </table>
                                <div class="container ">
                                <br>
                                            <span><img src="uploads/<?php echo $row['Booking_attachment']?>" alt="" width="500" height="500"></span>
                                            <?php echo $row['Booking_attachment'];?>
                                            <br>
                                            <textarea class="w3-input w3-border" name="messages"  cols="30" rows="10" placeholder="Write Messages / Leave Messages" required></textarea>
                                            <br>
                                            <bUtton class="w3-green w3-btn" name="updates">Approve</bUtton>
                                            <bUtton class="w3-red w3-btn" name="disapproved">Disapprove</bUtton>
                                            <br><br>
                            </div>
                            </div>
                        <?php
                    }
                }
            ?>
        </form> 
       </div> 
             </div>
    </div>
    </div>
    <br>
    <br>
   
    <script  type="text/javascript">
   
    </script>
    <footer style="margin-left:20%" class="w3-container w3-teal">
    <h5>Footer</h5>
    <p>Footer information goes here</p>
    </footer>
        </body>

    </html>