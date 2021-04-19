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
        <h1>Add user</h1>
    </div>
    <div class="w3-container" style="margin-left:20%">
        <br>
       
            <br><br>
<div class="w3-container" > 
  <button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-teal">Add User</button>

    <br><br>
    <div id="id02" class="w3-modal">
    <div class="w3-modal-content w3-animate-top" style="width:40%;">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('id02').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2>ADD USER</h2>
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
        <h2>ADD USER</h2>
      </header>
      <div class="w3-container">
      <form class="w3-container" action="includes/add_user.php" method="POST">
          <br>
        <label class="w3-text-teal"><b>Complete Name</b></label>
        <input class="w3-input w3-border w3-light-grey" type="text" name="completename" required>
        <label class="w3-text-teal"><b> Address </b></label>
        <input class="w3-input w3-border w3-light-grey" type="text" name="user_address" required>
        <label class="w3-text-teal"><b> Email Address </b></label>
        <input class="w3-input w3-border w3-light-grey" type="email" name="emailAddress" required>
        <label class="w3-text-teal"><b> Username </b></label>
        <input class="w3-input w3-border w3-light-grey" type="text" name="user_username" required>
        <label class="w3-text-teal"><b> Password </b></label>
        <input class="w3-input w3-border w3-light-grey" type="password" name="user_password" required>
        <label class="w3-text-teal"><b> Type </b></label>
        <select class="w3-input w3-border w3-light-grey" name="user_type" id="" required> 
            <option value="user">User</option>
            <option value="admin">Admin</option>
            <option value="superadmin">Super Admin</option>
        </select>
        <br>
        <button class="w3-btn w3-teal" name="adduser">Add</button>
        <button class="w3-btn w3-red" name="cancel">Cancel</button>
        <br>
    </form>
    <br>
      </div>
      <footer class="w3-container w3-teal">
        <p></p>
      </footer>
    </div>
</div>

    <div class="container" style="overflow: scroll; height:50%;">
            <table class="w3-table-all w3-hoverable">
            <thead>
            <tr class="w3-light-grey">
                <th>Complete Name</th>
                <th>Address</th>
                <th>Email Address</th>
                <th>Username</th>
                <th>Password</th>
                <th>Type</th>
            
            </tr>
            </thead>
            <?php
                        
                            $sql = "SELECT * FROM user_tb ";
                            $stmt = $conn->prepare($sql); 
                        
                            $stmt->execute();
                            $result = $stmt->get_result();
                        
                            while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td><?php echo $row['user_complete_name'];?></td>
                                        <td><?php echo $row['user_address'];?></td>
                                        <td><?php echo $row['user_email_add'];?></td>
                                        <td><?php echo $row['user_username'];?></td>
                                        <td><?php echo $row['user_password'];?></td>
                                        <td><?php echo $row['user_type'];?></td>
                                    
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
   
    </script>
    <footer style="margin-left:20%" class="w3-container w3-teal">
    <h5>Footer</h5>
    <p>Footer information goes here</p>
    </footer>
        </body>

    </html>