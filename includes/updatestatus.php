<?php
include "../includes/connection.php";
if(isset($_POST['updates'])){
    

    $bookingid = $_POST['bookingid'];
   $messages = $_POST['messages'];
   $stat ='2';

   $querys = $conn->prepare("UPDATE booking_tb SET book_status=?, booking_messages=? WHERE booking_id=?");
   $querys->bind_param('ssi', $stat, $messages, $bookingid );
   $querys->execute();

if($querys==true){
    echo $bookingid;

    $sqls = "SELECT * FROM booking_tb WHERE booking_id=?";
    $stmt = $conn->prepare($sqls); 
    $stmt->bind_param("i", $bookingid);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $brand = 'TN';
        $cur_date = date('d').date('m').date('y');
        $invoice = $brand.$cur_date;
        $customer_id = rand(00000 , 99999);
        $uRefNo = $invoice.'-'.$customer_id;
        $ticketname = $row['Booking_tckt_name'];
        $ticketType = $row['Booking_type'];
        $ticketprice = $row['Booking_price'];
        
        $boatidid = $row['Boat_ID'];
        $uerbookId=$row['user_book_id'];

        $sqlss = "SELECT * FROM boat_tb WHERE BoatId=?";
        $stmtss = $conn->prepare($sqlss); 
        $stmtss->bind_param("i", $boatidid);
        $stmtss->execute();
        $results = $stmtss->get_result();
        while ($rows = $results->fetch_assoc()) {
        $boatName = $rows['BoatName'];
        $BoatDestination = $rows['BoatDestination'];
        $BoatTime = $rows['BoatTime'];
        $BoatDate = $rows['BoatDate'];  
        $capacity = $rows['boat_capacity'];  
        $count='1';
        $capa=$capacity-$count; 
       
            $query = $conn->prepare("UPDATE boat_tb SET boat_capacity=? WHERE BoatId=?");
            $query->bind_param('si', $capa, $boatidid );
            $query->execute();
        }
        $stmts = $conn->prepare('INSERT INTO cart_tb (ticket_number, ticket_name, ticket_type, ticket_price, booking_id, uer_booking_id, boat_id, BoatName, BoatDestination, BoatTime, BoatDate, transaction_type, status) 
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, 1)');
        $stmts->bind_param("sssssssssss",$uRefNo, $ticketname, $ticketType, $ticketprice, $bookingid, $uerbookId, $boatidid, $boatName, $BoatDestination, $BoatTime, $BoatDate );
        $stmts->execute();
        if ($stmts==true) {
         
              header("location:../adminHome.php");
        }else{
            echo 'failed';
        }
     
    }
}
}

if(isset($_POST['disapproved'])){

    $messagesi = $_POST['messages'];
    $bookingid = $_POST['bookingid'];
    $stats='3';
   
    $querysi = $conn->prepare("UPDATE booking_tb SET book_status=?, booking_messages=? WHERE booking_id=?");
    $querysi->bind_param('ssi', $stats, $messagesi, $bookingid );
    $querysi->execute();
    if($querysi==true){
       
        header("location:../adminHome.php");
    }else{
        echo "failed";
    }
}


?>