<html>
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
</html>
<?php
include "../includes/connection.php";
session_start();
    if(isset($_POST['print'])){
        
        $bookingid = $_POST['bookingid'];
        $sqlss = "SELECT * FROM cart_tb WHERE booking_id=?  ";
        $stmtss = $conn->prepare($sqlss); 
        $stmtss->bind_param('s', $_POST['bookingid']);
        $stmtss->execute();
        $stmtss->store_result();

        if($stmtss->num_rows > 0){
            $stmtss->bind_param("i", $bookingid);
            $stmtss->execute();
            $results = $stmtss->get_result();
            while ($rows = $results->fetch_assoc()) {
                   echo'ANGASIL TICKETING <br>
                    Lapu-Lapu City <br>';
                echo '<div class="w3-container"> 
                    <br>
                    Ticket Number : '.$rows['ticket_number'].' <br>
                    Ticket Name : '.$rows['ticket_name'].'<br>
                    Boat Name : '.$rows['BoatName'].' <br>
                    Destination : '.$rows['BoatDestination'].'<br>
                    Boat Time : '.$rows['BoatTime'].'<br>
                    Date : '.$rows['BoatDate'].'<br>
                    Type: '.$rows['ticket_type'].'<br>
                    Price: '.$rows['ticket_price'].'<br>  
                    <br>
                    <br>
                    Thank and Godbless...
                    <br>
                    '.php_uname().'
            </div>';
            echo'<script>window.print();</script>';
                    echo'<form action="../userBooking.php" method="POST">';
                    echo'<button id="print" onclick="window.print();">Print</button>';
                    echo'<button id="back" name="backs">Back</button>';
                    echo'</form>';
                    if(isset($_POST['backs'])){
                        
                        header("location:../userBooking.php");
                    }else{
                        
                    } 
                }
            
        }else{
            echo "<script>
                     alert('Your Booking is already used or already pass the date of your book');
                     window.location.href='../userBooking.php';
                </script>";
        }
       

    // 
    //     
        
    }
   
?>
