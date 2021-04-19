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
      <style>
      #displayDiv {
  background-color: #eee;
  width: auto;
  height: 200px;  border: 1px dotted black;
  overflow: auto;
}
      </style>
        
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
    <a href="adminPassenger.php" class="w3-bar-item w3-button">Passengers</a>
    
    </div>
        <div style="margin-left:20%" class="w3-container w3-teal">
        <h1>Passenger Info</h1>
        <div class="container">
    <?php
        $dated = date("Y-m-d");
        echo $dated;
    ?>
</div>
    </div>
    <div class="w3-container" style="margin-left:20%">
    <br>
    <div class="w3-row w3-padding " id="displayDiv">
        <?php
            $sqlsi = "SELECT * FROM boat_tb WHERE BoatDate=? and status=1";
            $stmti = $conn->prepare($sqlsi); 
            $stmti->bind_param("s", $dated);
            $stmti->execute();
            $resulti = $stmti->get_result();
        
                while ($row = $resulti->fetch_assoc())
                {?>
                        <div class="w3-third w3-teal w3-card-4 w3-padding w3-aln-right">
                        <span><img src="images/boat.png" style="width:50px;" alt=""></span><br>
                            <?php
                                    echo 'Boat Name:'.$row['BoatName'].'<br>';
                                    echo 'Destination:'.$row['BoatDestination'].'<br>';
                                    echo 'Time:'.$row['BoatTime'].'<br>';
                                    echo 'Remaining Slot:'.$row['boat_capacity'].'<br>';
                                    echo 'Capacity:'.$row['original_capacity'];
                            ?>
                        </div>
                        
            <?php
                }
            ?>
             </div>
        <div class="w3-container">
            <Br>
            <button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-teal">Add Walkin</button>
            <button onclick="document.getElementById('id03').style.display='block'" class="w3-button w3-teal">Encode Booking</button>
            <button onclick="document.getElementById('id02').style.display='block'" class="w3-button w3-teal">Save and Print </button>

            <div id="id01" class="w3-modal">
                <div class="w3-modal-content" style="width: 50%;">
                <div class="w3-container">
                    <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright w3-red">&times;</span>
                </div>
                    <form class="w3-container w3-card-4" action="includes/add_cart.php" method="POST" >
                        <h2 class="w3-text-teal">Add Passenger Form</h2>
                        <p>    
                        <label class="w3-text-teal"><b>Choose Boat</b></label>  
                 <Select name="boat" class="w3-input w3-border">
                    <?php

                $sqls = "SELECT * FROM boat_tb WHERE BoatDate=? and status=1";
                $stmt = $conn->prepare($sqls); 
                $stmt->bind_param("s", $dated);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                            ?>
                           
                            <option value="<?php echo $row['BoatId'];?>"><?php echo $row['BoatName'] , $row['BoatDestination'], $row['BoatTime'], $row['BoatDate'];?></option>
                            <?php
                        }
                    
                ?>
                
                </Select>
                        <p>      
                        <label class="w3-text-teal"><b>Passenger's Name</b></label>
                        <input class="w3-input w3-border" name="tcktname" type="text" placeholder="Firsname |Lastname" required></p>
                        <p>      
                        <label class="w3-text-teal"><b>Ticket Type</b></label>
                        <select name="type" class="w3-input w3-border" onchange='selectOnChange(this)' required>
                            <option value="Select Type">choose</option>
                            <option value="30">Regular</option>
                            <option value="25">Student</option>
                            <option value="20">PWD / Senior Citizen</option>
                        </select>
                        </p>
                        <p>
                            <label class="w3-text-teal"><b>Add Cargo</b></label>
                            <select name="kilos" class="w3-input w3-border" onchange='selectOnChanges(this)' required>
                            <option value=""></option>
                            <option value="0">Below 10 Kls</option>
                            <option value="20">Above 10 Kls</option>
                            <option value="30">Above 20 Kls</option>
                            <option value="40">Above 30 Kls</option>
                            <option value="50">Above 50 kls </option>
                        </select>
                        </p>
                        <p>
                        <label class="w3-text-teal"><b>Price</b></label>
                        <input class="w3-input w3-border" name="prices" id="price" type="text" readonly></p>
                        <p>       
                        <button class="w3-btn w3-teal" name="addPassenger">Add Passenger</button></p>
                    </form>
                
                </div>
            </div>
            <div id="id02" class="w3-modal">
                <div class="w3-modal-content" style="width: 50%;">
                <div class="w3-container">
                    <span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-display-topright w3-red">&times;</span>
                </div>
                    <form class="w3-container w3-card-4" action="adminRemit.php" method="POST" >
                        <h2 class="w3-text-teal">Save Form</h2>
                        <p>      
                        <label class="w3-text-teal"><b>Choose Boat</b></label>
                 <Select name="boatid" class="w3-input w3-border" required>
                    <?php
                    $status='1';
                    
                $sqls = "SELECT * FROM boat_tb WHERE status=?";
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
                
                </Select>
                       <br>
                        <button class="w3-btn w3-teal" name="generate">Generate</button></p>
                    </form>
                
                </div>
            </div>
            
    <div id="id02" class="w3-modal">
                <div class="w3-modal-content" style="width: 50%;">
                <div class="w3-container">
                    <span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-display-topright w3-red">&times;</span>
                </div>
                    <form class="w3-container w3-card-4" action="adminRemit.php" method="POST" >
                        <h2 class="w3-text-teal">Save Form</h2>
                        <p>      
                        <label class="w3-text-teal"><b>Choose Boat</b></label>
                 <Select name="boatid" class="w3-input w3-border">
                    <?php
                    $status='1';
                    
                $sqls = "SELECT * FROM boat_tb WHERE status=?";
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
                
                </Select>
                       <br>
                        <button class="w3-btn w3-teal" name="generate">Generate</button></p>
                    </form>
                
                </div>
            </div>
            <div id="id03" class="w3-modal">
                <div class="w3-modal-content" style="width: 50%;">
                <div class="w3-container">
                    <span onclick="document.getElementById('id03').style.display='none'" class="w3-button w3-display-topright w3-red">&times;</span>
                </div>
                    <form class="w3-container w3-card-4" action="" method="POST" >
                        <h2 class="w3-text-teal">Validate Ticket</h2>
                        <p>      
                        <label class="w3-text-teal"><b>Ticket Number</b></label>
                        <input type="text" class="w3-input w3-border" name="tckt_num" required>
                       <br>
                        <button class="w3-btn w3-teal" name="addRes">Add</button></p>
                        <?php
                            if(isset($_POST['addRes'])){
                                
                                $tckt_num = $_POST['tckt_num'];
                                $query = "SELECT * FROM cart_tb WHERE ticket_number=? ";
                                $stmtsi = $conn->prepare($query); 
                                $stmtsi->bind_param("s", $tckt_num);
                                $stmtsi->execute();
                                $resultsi = $stmtsi->get_result();
                                while ($rows = $resultsi->fetch_assoc()) {
                                        $idssi = $rows['cart_id'];
                                    echo $idssi;
                                $querys = $conn->prepare("UPDATE cart_tb SET transaction_type=3, status=3 WHERE cart_id=?");
                                $querys->bind_param('i', $idssi );
                                $querys->execute();
                                        echo"
                                        <script>
                                            alert('Succesfully Encoded,".$rows['ticket_name']."');
                                        </script>
                                        ";
                                }
                               
                            }
                        ?>
                    </form>
                        
                </div>
            </div>
            
</div>


    <div class="w3-container" > 
                <br><br>
    <form class="w3-container" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
          <br>
        <select class="w3-input w3-border w3-light-grey" name="boatids" onchange="this.form.submit()"  >
        <option value="">Choose Boat</option>
        <?php
        
                $status='1';
                $datenow = date("Y-m-d");
                $sqls = "SELECT * FROM boat_tb WHERE status=? and BoatDate=? ORDER BY BoatDate DESC";
                $stmt = $conn->prepare($sqls); 
                $stmt->bind_param("ss", $status, $datenow);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                            ?>
                            
                            <option value="<?php echo $row['BoatId'];?>"><?php echo $row['BoatName'] , $row['BoatTime'], $row['BoatDate'];?></option>
                            <?php
                        }
                    
                ?>
        </select>
       
        <table class="w3-table">
            <tr>
                <th>Boat Name</th>
                <th>Boat Time</th>
                <th>Ticket Number</th>
                <th>Passenger Name</th>
                <th>Ticket Type</th>
                <th>Ticket Price</th>
                <th>Type</th>

            </tr>
        <?php
         
            if(empty($_POST['boatids'])){
                echo "please choose";
            }else{
            
                    $boatids = mysqli_real_escape_string($conn, $_POST['boatids']);
                  
                    $sqlss = "SELECT * FROM cart_tb WHERE boat_id=? ORDER BY BoatDate DESC";
                    $stmts = $conn->prepare($sqlss); 
                    $stmts->bind_param("s", $boatids);
                    $stmts->execute();
                    $results = $stmts->get_result();
                    while ($rows = $results->fetch_assoc()) {
                    ?>    
                    
                        <tr>
                            
                            <td><?php echo $rows['BoatName']?></td>
                            <td><?php echo $rows['BoatTime']?></td>
                            <td><?php echo $rows['ticket_number']?></td>
                            <td><?php echo $rows['ticket_name']?></td>
                            <td><?php echo $rows['ticket_type']?></td>
                            <td><?php echo $rows['ticket_price']?></td>
                            <td>
                                <?php 
                                    if($rows['transaction_type']==2){
                                        echo "Walkin";
                                    }else if($rows['transaction_type']==1){
                                       echo "Not yet encoded";
                                    }else{
                                        echo "Booking";
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
            }
        ?>
     </table>
    </form>
    </div>
    </div>

    <script  type="text/javascript">
    function selectOnChange(obj) {
          var val = obj.options[obj.selectedIndex].value;
         var text = obj.options[obj.selectedIndex].text;
         document.getElementById("price").value = val;
        
      }
      function selectOnChanges(obj) {
          var value = obj.options[obj.selectedIndex].value;
         var text = obj.options[obj.selectedIndex].text;
        var pricess = document.getElementById("price").value;  
        var total = +value + +pricess; 
         document.getElementById("price").value = total;
        
      }
    </script>
    <footer style="margin-left:20%" class="w3-container w3-teal">
    <h5>Footer</h5>
    <p>Footer information goes here</p>
    </footer>
        </body>

    </html>