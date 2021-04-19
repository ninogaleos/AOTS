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
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
        <script src="css/js/jquery-3.5.1.js"></script>
        <script src="css/js/jquery.dataTables.min.js"></script>
        <script src="css/js/dataTables.bootstrap.min.js"></script>
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
        <a class="w3-text-white"href="includes/logout.php">Logout</a>
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
        <table id="example" class="table table-striped table-bordered">
            <thead>
            <tr class="w3-light-grey">
                <th>Reference Number</th>
                <th>User Complete Name</th>
                <th>Booking Date</th>
                <th>Booking Name</th>
                <th>Action</th>
                
            
            </tr>
            </thead>
            <?php
                        
                            $sql = "SELECT * FROM booking_tb where book_status=1 ORDER BY booking_id DESC";
                            $stmt = $conn->prepare($sql); 
                            $stmt->execute();
                            $result = $stmt->get_result();
                        
                            while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td><?php echo $row['Booking_reference'];?></td>
                                        <td><?php echo $row['user_name'];?></td>
                                        <td><?php echo $row['Booking_date'];?></td>
                                        <td><?php echo $row['Booking_tckt_name'];?></td>
                                        <td>
                                            <?php
                                                    if($row['book_status']==1){
                                                    ?>
                                                        <form action="adminview.php" method="POST">
                                                            <input type="number" name="booking_id" value='<?php echo $row['booking_id'];?>' hidden>
                                                            <button class="w3-green w3-btn" name="view_booking">View</button>
                                                        </form>
                                                    <?php
                                                    }
                                                    else if($row['book_status']==2){
                                                        ?>
                                                        <form action="" method="POST">
                                                        <input type="number" name="book_id" value='<?php echo $row['booking_id'];?>' hidden>
                                                        <button class="w3-teal w3-btn" disabled>Approved</button>
                                                        </form>
                                                    <?php
                                                    }else{
                                                        ?>
                                                        <button class="w3-red w3-btn">Disapproved</button>
                                                    <?php
                                                    }
                                            ?>
                                        </td>
                                       
                                    
                                    </tr>
                                
                            <?php
                            
                            }?>
        </table>
         </div>
</div>
<br><br>
<footer style="margin-left:20%" class="w3-container w3-teal">
    <h5>Footer</h5>
    <p>Footer information goes here</p>
    </footer>
    <script  type="text/javascript">
    function selectOnChange(obj) {
          var val = obj.options[obj.selectedIndex].value;
         var text = obj.options[obj.selectedIndex].text;
         document.getElementById("price").value = val;
         document.getElementById("total").value = val+'.00';
        
      }
      $(document).ready(function() {
    $('#example').DataTable();
} );
    </script>
    
        </body>

    </html>