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
        <h1>Passenger List</h1>
    </div>
    <div class="w3-container" style="margin-left:20%">
        <br>
        <button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-teal">Generate Report</button>
            <br><br>
  
  <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-animate-top" style="width:40%;">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('id01').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2>Generate Report</h2>
      </header>
      <body>
      <div class="w3-container w3-padding">
        <form action="adminPassengerReport.php" method="POST" class="w3-container">
        <label class="w3-text-teal"><b>From</b></label>
        <input type="date" class="w3-input w3-border" name="from">
        <label class="w3-text-teal"><b>To</b></label>
        <input type="date" class="w3-input w3-border" name="to">
        <br>
        <button class="w3-btn w3-teal" name="search">Search</button>
        <br>
        </form>
      </div>
      
      </body>
  </div>
    </div>
  <div class="w3-container">
    <table id="example" class="table table-striped table-bordered">
    <thead>
      <tr class="w3-light-grey">
        <th>Ticket Number</th>
        <th>Passenger Name</th>
        <th>Passenger Type</th>
        <th>Boat Name</th>
        <th>Boat Destination</th>
        <th>Boat Time</th>
        <th>Boat Date</th>
      </tr>
    </thead>
    <?php
                  
                    $sql = "SELECT * FROM passenger_tb ORDER BY BoatDate DESC";
                    $stmt = $conn->prepare($sql); 
                  
                    $stmt->execute();
                    $result = $stmt->get_result();
                   
                    while ($row = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?php echo $row['ticket_number'];?></td>
                                <td><?php echo $row['Passenger_name'];?></td>
                                <td><?php echo $row['Passenger_type'];?></td>
                                <td><?php echo $row['Boat_name'];?></td>
                                <td><?php echo $row['BoatDestination'];?></td>
                                <td><?php echo $row['BoatTime'];?></td>
                                <td><?php echo $row['BoatDate'];?></td>
                             
                            </tr>
                        
                    <?php
                    
                    }?>
  </table>
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