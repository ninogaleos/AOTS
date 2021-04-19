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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        <h1>Booking Ticket</h1>
    </div>
    <div class="w3-container" style="margin-left:20%">
        <br>
        <div class="w3-row">
            <div class="w3-third w3-center">
                     <?php
                    $stat = '1';
                    $sqlsi = "SELECT COUNT(*) as 'BookingPending' FROM booking_tb WHERE Book_status=?";
                    $stmti = $conn->prepare($sqlsi); 
                    $stmti->bind_param("s", $stat);
                    $stmti->execute();
                    $resulti = $stmti->get_result();


                        while ($row = $resulti->fetch_assoc())
                        {?>
                                <div class="w3-third w3-center">
                                    <?php
                                            echo 'Total Pending Booking:'.$row['BookingPending'];
                                    ?>
                                </div>
                    <?php
                        }
                    ?>
                </div>
                <div class="w3-third w3-center">
                     <?php
                    $stat = '2';
                    $sqlsi = "SELECT COUNT(*) as 'BookingPending' FROM booking_tb WHERE Book_status=?";
                    $stmti = $conn->prepare($sqlsi); 
                    $stmti->bind_param("s", $stat);
                    $stmti->execute();
                    $resulti = $stmti->get_result();


                        while ($row = $resulti->fetch_assoc())
                        {?>
                                <div class="w3-third w3-center">
                                    <?php
                                            echo 'Total Approve Booking:'.$row['BookingPending'];
                                    ?>
                                </div>
                    <?php
                        }
                    ?>
                </div>
                <div class="w3-third w3-center">
                     <?php
                    $stat = '3';
                    $sqlsi = "SELECT COUNT(*) as 'BookingPending' FROM booking_tb WHERE Book_status=?";
                    $stmti = $conn->prepare($sqlsi); 
                    $stmti->bind_param("s", $stat);
                    $stmti->execute();
                    $resulti = $stmti->get_result();


                        while ($row = $resulti->fetch_assoc())
                        {?>
                                <div class="w3-third w3-center">
                                    <?php
                                            echo 'Total Cancel Booking:'.$row['BookingPending'];
                                    ?>
                                </div>
                    <?php
                        }
                    ?>
                </div>
        </div>
            <br><br>


<div class="w3-container " > 
        <form action="#" method="POST">
            <label> REFERENCE NUMBER</label>
            <input type="text" name="referencenum">
            <button name="search" class="w3-btn w3-teal">Search</button>
            <br><br>
            </form>
            </div>
     <div class="w3-container w3-padding w3-card-4 w3-middle" style="width:100%">      
            <header class="w3-container w3-teal ">
               <h4>Validate Booking</h4>
            </header>
            <form action="includes/updatestatus.php" method="POST">
            <?php
                include "includes/connection.php";
                if(isset($_POST['search'])){
                    $reference = $_POST['referencenum'];
                    $stats = '1';
                    $sql = "SELECT * FROM booking_tb WHERE Booking_reference=? and book_status=?";
                    $stmt = $conn->prepare($sql); 
                    $stmt->bind_param("ii", $reference, $stats);
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
       <br><br>
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