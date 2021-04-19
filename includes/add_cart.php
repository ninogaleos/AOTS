<style>
@media print{
    @page{
        size: auto;
         margin: 0;
    }
    #print{
        display:none;
    }
    #back{
        display:none;
    }

}
</style>
<?php
include "../includes/connection.php";
session_start();
if(!isset($_SESSION["loggedin"])){
    header('Location: index.php');
    exit;
  }
    if(isset($_POST['addPassenger'])){
        $boat = $_POST['boat'];
        $sqls = "SELECT * FROM boat_tb WHERE boatId=?";
        $stmt = $conn->prepare($sqls); 
        $stmt->bind_param("i", $boat);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            if($row['boat_capacity']<=0){
                echo '<script type="text/javascript">'; 
                echo 'alert("The Boat Capacity is already 0 please remit");'; 
                echo 'window.location.href = "../adminPassenger.php";';
                echo '</script>';
            }else{
            $capacity=$row['boat_capacity'];
            $brand = 'TN';
            $cur_date = date('d').date('m').date('y');
            $invoice = $brand.$cur_date;
            $customer_id = rand(00000 , 99999);
            $uRefNo = $invoice.'-'.$customer_id;
            $BoatId = $row['BoatId'];
            $BoatName = $row['BoatName'];
            $BoatDestination = $row['BoatDestination'];
            $BoatTime = $row['BoatTime'];
            $BoatDate =  $row['BoatDate'];
            if($_POST['type']==30){
                $types="Regular";
            }else if($_POST['type']==25)
            {
                $types = "Student";
            }else if($_POST['type']==20){
                $types = "PWD / Senior Citizen";
            }else{
                echo "<script>
                alert('Error | Choose Type');
                window.location.href='../adminPassenger.php';
           </script>";
            }
            $type = $types;
            $tcktname = $_POST['tcktname'];
            $uerbookingid='1';
            $tcktprice = $_POST['prices'];
            $kilos = $_POST['kilos'];
            if($kilos > 0){
                 $count='2';
            }else{
                $count='1';
            }
            echo $count;
            $capa=$capacity-$count;
           
            
            $query = $conn->prepare("UPDATE boat_tb SET boat_capacity=? WHERE BoatId=?");
            $query->bind_param('si', $capa, $BoatId );
            $query->execute();
           
          
            $stmts = $conn->prepare('INSERT INTO cart_tb (ticket_number, ticket_name, ticket_type, ticket_price, uer_booking_id, boat_id, BoatName, BoatDestination, BoatTime, BoatDate, transaction_type, status) 
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 2, 1)');
            $stmts->bind_param("ssssssssss",$uRefNo, $tcktname, $type, $tcktprice, $uerbookingid, $BoatId, $BoatName, $BoatDestination, $BoatTime, $BoatDate );
            $stmts->execute();
            if ($stmts==true) {
                echo'ANGASIL TICKETING <br>
                        Lapu-Lapu City <br>';
                echo '<div class="w3-container"> 
                        <br>
                        Ticket Number : '.$uRefNo.' <br>
                        Ticket Name : '.$tcktname.'<br>
                        Boat Name : '.$BoatName.' <br>
                        Destination : '.$BoatDestination.'<br>
                        Boat Time : '.$BoatTime.'<br>
                        Date : '.$BoatDate.'<br>
                        Type: '.$type.'<br>
                        Price: '.$tcktprice.'<br>  
                        <br>
                        <br>
                        Thank and Godbless...
                        <br>
                        '.php_uname().'
                </div>';
                echo'<script>window.print();</script>';
                echo'<form action="../adminPassenger.php" method="POST">';
               echo'<button id="print" onclick="window.print();">Print</button>';
               echo'<button id="back" name="backs">Back</button>';
               echo'</form>';
               if(isset($_POST['backs'])){
                   
                header("location:../adminPassenger.php");
               }
            }else{
                echo 'failed';
            }
        }
            
        }
         
    }

    
?>
