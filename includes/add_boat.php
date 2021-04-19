<?php
include "../includes/connection.php";
// session_start();
    if(isset($_POST['addboat'])){

        $boatname=$_POST['boatname'];
        $boatdest=$_POST['boatdest'];
        $boattime=$_POST['boattime'];
        $dateed=date('h:i:sa',strtotime($boattime));
        $boatdate=$_POST['boatdate'];
        $boatcapa=$_POST['boatcapa'];
        $orig_capa=$_POST['boatcapa'];
        $arrivaltime = $_POST['arrivaltime'];
        $dateeds=date('h:i:sa',strtotime($arrivaltime));


      
        $stmt = $conn->prepare('INSERT INTO boat_tb (BoatName, BoatDestination, BoatTime, BoatDate, arrival_time, boat_capacity, original_capacity, status) VALUES( ?, ?, ?, ?, ?, ?, ?, 1)');
        $stmt->bind_param("sssssss", $boatname, $boatdest, $dateed, $boatdate, $dateeds, $boatcapa, $orig_capa);
        $stmt->execute();
        if ($stmt==true) {
            echo "<script>
                            alert('Succesfully Added ');
                            window.location.href='../adminboat.php';
                       </script>";
        }
        else{
            echo "<script>
                        alert('Failed to Post');
                 </script>";
        }
      
    }
    if(isset($_POST['cancel'])){
        header("location:../adminboat.php");
    }
   
?>