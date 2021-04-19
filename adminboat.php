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
        <a class="w3-text-white" href="includes/logout.php">Logout</a>
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
  <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-animate-top" style="width:50%;">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('id01').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2>ADD BOAT</h2>
      </header>
      <div class="w3-container">
      <form class="w3-container" action="includes/add_boat.php" method="POST">
          <br>
        <label class="w3-text-teal"><b>Boat Name</b></label>
        <input class="w3-input w3-border w3-light-grey" type="text" name="boatname">
        <label class="w3-text-teal"><b> Boat Route </b></label>
        <select class="w3-input w3-border w3-light-grey" name="boatdest" id="">
            <option value="Angasil To Olango">Angasil To Olango</option>
            <option value="Olango To Angasil">Olango To Angasil</option>
        </select>
        <label class="w3-text-teal"><b> Boat Time </b></label>
        <input class="w3-input w3-border w3-light-grey" type="time" name="boattime">
        <label class="w3-text-teal"><b> Arrival Time </b></label>
        <input class="w3-input w3-border w3-light-grey" type="time" name="arrivaltime">
        <label class="w3-text-teal"><b> Boat Date </b></label>
        <input class="w3-input w3-border w3-light-grey" type="date" name="boatdate">
        <label class="w3-text-teal"><b> Slot </b></label>
        <input class="w3-input w3-border w3-light-grey" type="number" name="boatcapa"> 
        <br>
        <button class="w3-btn w3-teal" name="addboat">Add</button>
        <button class="w3-btn w3-red" name="cancel">Cancel</button>
        <br>
    </form>
    <br>
      </div>
      
    </div>
</div>

<div class="w3-container" >
    <table id="example" class="table table-striped table-bordered">
    <thead>
      <tr class="w3-light-grey">
        <th>Boat Name</th>
        <th>Boat Route</th>
        <th>Boat Date</th>
        <th>Boat Time</th>
        <th>Arrival Time</th>
        <th>Boat Slot</th>
      
        <th>Status</th>

      </tr>
    </thead>
    <?php
                    $stat = '1';
                    $sql = "SELECT * FROM boat_tb WHERE status=? ORDER BY BoatDate DESC ";
                    $stmt = $conn->prepare($sql); 
                    $stmt->bind_param("i", $stat);
                    $stmt->execute();
                    $result = $stmt->get_result();
                   
                    while ($row = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?php echo $row['BoatName'];?></td>
                                <td><?php echo $row['BoatDestination'];?></td>
                                <td><?php echo $row['BoatDate'];?></td>
                                <td><?php echo date('h:i:s a',strtotime($row['BoatTime']));?></td>
                                <td><?php echo $row['arrival_time'];?></td>
                                <td><?php echo $row['boat_capacity'];?></td>
                                
                                <td><?php 
                                        if($row['status']==1){
                                            echo 'Available';
                                        }   
                                ?></td>
                             
                            </tr>
                        
                    <?php
                    
                    }?>
  </table>
    </div>
    </div>
    </div>
    <br>
    <br>
   
    <script  type="text/javascript">
         $(document).ready(function() {
    $('#example').DataTable();
} );
    </script>
    <footer style="margin-left:20%" class="w3-container w3-teal">
    <h5>Footer</h5>
    <p>Footer information goes here</p>
    </footer>
        </body>

    </html>