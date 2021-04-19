<?php
    include "includes/connection.php";
    session_start();
    if(!isset($_SESSION["loggedin"])){
        header('Location: index.php');
        exit;
    }
    ?>
<!doctype HTML>
<html lang="en">
<title>Angasil Online Ticket System</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/w3.css">
<style>

        @media print{
    @page{
        size: auto;
         margin: 0;
    }
    #printPageButton{
        display:none;
    }
    #savebtn{
        display:none;
    }
    #cancelbtn{
        display:none;
    }

}
   

</style>
<?php
        if(isset($_POST['save'])){
            $BoatID = $_POST['BoatID'];
     
            $sqlss = "SELECT * FROM cart_tb WHERE boat_id=?";
            $stmts = $conn->prepare($sqlss); 
            $stmts->bind_param("i", $BoatID);
            $stmts->execute();
            $results = $stmts->get_result();
            while ($row = $results->fetch_assoc()) {
                $passengername=$row['ticket_name'];
                $PassengerType=$row['ticket_type'];
                $ticket_number=$row['ticket_number'];
                $boatname=$row['BoatName'];
                $boatdestination=$row['BoatDestination'];
                $BoatTime=$row['BoatTime'];
                $boatdate = $row['BoatDate'];
               $stat = $row['status'];
     
                $stmtsss = $conn->prepare('INSERT INTO passenger_tb (Passenger_name, Passenger_type, ticket_number, Boat_name, BoatDestination, BoatTime, BoatDate, Passenger_stat) 
                VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
                $stmtsss->bind_param("ssssssss",$passengername, $PassengerType, $ticket_number, $boatname, $boatdestination, $BoatTime, $boatdate, $stat );
                $stmtsss->execute();
                if ($stmtsss==true) {
                    $bid=$BoatID;
                    echo $bid;
                 $sqlssi = "DELETE FROM cart_tb WHERE boat_id=?";
                 $stmtsi = $conn->prepare($sqlssi); 
                 $stmtsi->bind_param("i", $bid);
                 $stmtsi->execute();
                 $resultsi = $stmtsi->get_result();
                 
                 $query = $conn->prepare("UPDATE boat_tb SET status=2 WHERE BoatId=?");
                 $query->bind_param('i', $bid );
                 $query->execute();
                   header("location:adminPassenger.php");
                }else{
                    echo 'failed';
                }
                
            }
     
         }
         if(isset($_POST['cancel'])){
             header("location:adminPassenger.php");
         }
?>
 <div class="w3-container w3-right">
 <form method="POST">
 <button id="printPageButton" class="w3-button w3-green" onClick="window.print();">Print</button>
 <button id="savebtn" name="save" class="w3-button w3-black">Save</button>
 <button id="cancelbtn" class="w3-button w3-red" name="cancel">Cancel</button>
</div>
    <head>
    <div class="w3-container w3-center">
        <h2>ANGASIL TICKETING</h1>
        <h3>Lapu-Lapu City</h3>
    </div>
       
</head>  

<body>
<br><br>
 
    <div class="w3-container">
        <?php
            if(isset($_POST['generate'])) {
               $boatid = $_POST['boatid'];
               
               echo "<input type='text' value='".$boatid."' name='BoatID' hidden>";
            
        ?>
            <div class="w3-container">
                   <?php
                        $sqls = "SELECT * FROM boat_tb WHERE BoatId=?";
                        $stmts = $conn->prepare($sqls); 
                        $stmts->bind_param("i", $boatid);
                        $stmts->execute();
                        $results = $stmts->get_result();
                       
                        while ($row = $results->fetch_assoc()) {
                            echo "Boat Name:",$row['BoatName'],"<br>";
                            echo "Boat Destination:",$row['BoatDestination'],"<br>";
                            echo "Boat Time:",$row['BoatTime'],"<br>";
                            echo "Boat Date:",$row['BoatDate'],"<br>";

                        }
                   ?>
            </div>
            <br>
         <table width="" class="w3-table-all w3-hoverable">
                            <tr>
                                <th>Transaction Type</th>
                                <th>Ticket Number</th>
                                <th>Ticket Name</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Status</th>
                              
                            </tr>
                            
                    <?php
                
                    $sql = "SELECT * FROM cart_tb WHERE boat_id=?";
                    $stmt = $conn->prepare($sql); 
                    $stmt->bind_param("i", $boatid);
                    $stmt->execute();
                    $result = $stmt->get_result();
                   
                    while ($row = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?php 
                                        if($row['transaction_type']==1){
                                            echo 'Booking | Not use';
                                        }else if($row['transaction_type']==2){
                                            echo 'Walk-in';
                                        }else{
                                            echo'Booking';
                                        }
                                ?></td>
                                <td><?php echo $row['ticket_number'];?></td>
                                <td><?php echo $row['ticket_name'];?></td>
                                <td><?php echo $row['ticket_type'];?></td>
                                <td><?php echo $row['ticket_price'];?></td>
                                <td><?php 
                                    if($row['status']==1){
                                        echo "encoded";
                                    }else if($row['status']==2){
                                        echo "Not encoded";
                                    }else{
                                        echo " encoded";
                                    }
                                ?></td>
                                
                            </tr>
                    <?php
                    }
                       
                    }?>
                    </table>
                    <br><br>
                    <div class="w3-container w3-right">
                    <?php
                        $sqlss = "SELECT * FROM cart_tb WHERE boat_id=?";
                        $stmtss = $conn->prepare($sqlss); 
                        $stmtss->bind_param("i", $boatid);
                        $stmtss->execute();
                        $resultss = $stmtss->get_result();
                        $qty=0;
                        $qtys=0;
                        foreach($resultss as $row){
                           
                            if($row['transaction_type']==2){
                                $qtys += $row['ticket_price'];
                            }else if($row['transaction_type']==3){
                                $qty += $row['ticket_price'];
                            }
                           
                        }

                    ?>
                    <label>Walk-in Total</label>
                     <input type="number" name="tckt_overtotal" id="totalequals" value="<?php echo $qtys;?>"  >
                    <br>
                    <label>Booking Total</label>
                    <input type="number" value="<?php echo $qty;?>">
                    </div>
                   

    </div>
    </form>
</body>
<footer class="w3-footer">
            <?php
                    echo php_uname();
            ?>
</footer>
<script>
   function printpage() {
        //Get the print button and put it into a variable
        var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        //Print the page content
        window.print()
        printButton.style.visibility = 'visible';
    }
</script>
</html>