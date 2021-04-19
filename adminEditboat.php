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
        <h1>Edit Boat</h1>
    </div>
<div class="w3-container" style="margin-left:20%">
        <br>
       
            <br><br>
<div class="w3-container" > 
<form class="w3-container" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
          <br>
        <select class="w3-input w3-border w3-light-grey" name="boatid" onchange="this.form.submit()"  >
        <option value="">choose boat</option>
        <?php
                $status='1';
                $sqls = "SELECT * FROM boat_tb WHERE status=? ORDER BY BoatDate DESC";
                $stmt = $conn->prepare($sqls); 
                $stmt->bind_param("s", $status);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                            ?>
                           
                            <option value="<?php echo $row['BoatId'];?>"><?php echo $row['BoatName'] , $row['BoatDestination'], $row['BoatTime'], $row['BoatDate'];?></option>
                            <?php
                        }
                    
                ?>
        </select>
        <?php
           
            
            if(empty($_POST['boatid'])){
                echo "please choose";
            }else{
                    $boatid = mysqli_real_escape_string($conn, $_POST['boatid']);
                    $sqlss = "SELECT * FROM boat_tb WHERE BoatId=? ORDER BY BoatDate DESC";
                    $stmts = $conn->prepare($sqlss); 
                    $stmts->bind_param("s", $boatid);
                    $stmts->execute();
                    $results = $stmts->get_result();
                    while ($row = $results->fetch_assoc()) {
                                ?>
                                <br>
                                <br>
                                <div class="container w3-card" style="width:40%;">
                                    <form action="" method="post" >
                                        <input type="text" value="<?php echo $row['BoatId']?>" name="bid" hidden>
                                        <label class="w3-text-teal"><b> Boat Name </b></label>
                                        <input class="w3-input w3-border w3-light-grey" type="text" name="boatname" value="<?php echo $row['BoatName'];?>">
                                        <label class="w3-text-teal"><b> Boat Destination </b></label>
                                        <input class="w3-input w3-border w3-light-grey" type="text" name="boatdest" value="<?php echo $row['BoatDestination'];?>">
                                        <label class="w3-text-teal"><b> Boat Time </b></label>
                                        <input class="w3-input w3-border w3-light-grey" type="text" name="boattime" value="<?php echo $row['BoatTime'];?>">
                                        <label class="w3-text-teal"><b> Boat Date </b></label>
                                        <input class="w3-input w3-border w3-light-grey" type="date" name="boatdate" value="<?php echo $row['BoatDate'];?>">
                                        <label class="w3-text-teal"><b> Boat Capacity </b></label>
                                        <input class="w3-input w3-border w3-light-grey" type="number" name="boatcapa" value="<?php echo $row['boat_capacity'];?>">
                                        <br>
                                        <button class="w3-btn w3-teal" name="updateboat">Update</button>
                                        <button class="w3-btn w3-red" name="deleteboat">Delete</button>
                                    </form>
                                </div>
                                
                                <?php
                            }
                }
                if(isset($_POST['updateboat'])){
                    $bid = $_POST['bid'];
                    $boatname = $_POST['boatname'];
                    $boatdest = $_POST['boatdest'];
                    $boattime = $_POST['boattime'];
                    $boatdate = $_POST['boatdate'];
                    $boatcapa = $_POST['boatcapa'];
                    
                    $stmtr = $conn->prepare(' UPDATE boat_tb set BoatName = ?, BoatDestination = ?, BoatTime = ?, BoatDate = ?, boat_capacity = ? where BoatId = ? ');
                    $stmtr->bind_param("sssssi",$boatname, $boatdest, $boattime, $boatdate, $boatcapa, $bid);
                    $stmtr->execute();
                    if ($stmtr==true) {
                        echo "<script>
                                    alert('Success Updated');
                            </script>";
                    }
                    else{
                        echo "<script>
                                    alert('Failed to Post');
                            </script>";
                    }
                
                }
            if(isset($_POST['deleteboat'])){

                $bid = $_POST['bid'];
                $stmtrs = $conn->prepare('DELETE FROM boat_tb where BoatId=? ');
                $stmtrs->bind_param("i",$bid);
                $stmtrs->execute();
                if ($stmtrs==true) {
                    echo "<script>
                                alert('Succesfully Deleted');
                        </script>";
                }
                else{
                    echo "<script>
                                alert('Failed to Post');
                        </script>";
                }
            }
        ?>
        <br>
        <br>
    </form>
</div>
</div>
    <script  type="text/javascript">
   
    </script>
    <footer style="margin-left:20%" class="w3-container w3-teal">
    <h5>Footer</h5>
    <p>Footer information goes here</p>
    </footer>
        </body>

    </html>